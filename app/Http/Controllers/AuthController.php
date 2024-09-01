<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAfiliadoRequest;
use App\Models\Actividad;
use App\Models\Afiliado;
use App\Models\MateriaPrima;
use App\Models\Producto;
use App\Models\Role;
use App\Models\Servicio;
use App\Models\SolicitudAfiliado;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function registerForm(string $confirmation_code = '') {
        
        $solicitud = SolicitudAfiliado::where('confirmation_code', $confirmation_code)->first();
        $actividades = Actividad::all();
        $productos = Producto::all();
        $materias_primas = MateriaPrima::all();
        $servicios = Servicio::all();
        $afiliado = new Afiliado();
        $afiliados = Afiliado::all();

        if(!$solicitud) {
            return redirect()->route('auth.login');
        }
    
        return view('auth.register', compact(
            'solicitud',
            'afiliado',
            'actividades',
            'productos',
            'materias_primas',
            'servicios',
            'afiliados'
        ));
    }

    public function loginForm() {
        return view('auth.login');
    }

    public function login(Request $request) {
        /**
         * VALIDATE DATA
         */
        $credentials = $request->validate([
            'email'     => 'required|email',
            'password'  => 'required|min:8'
        ]);

        /**
         * AUTH USER
         */
        if(Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('dashboard')->with('success', 'Bienvenido ' . Auth::user()->name . '!');
        }

        /**
         * MANAGE ERROR
         */
        return back()->withErrors([
            'email' => 'Los datos no coinciden con nuestros registros.'
        ])->onlyInput('email');
    }

    public function register(StoreAfiliadoRequest $request) {
        $payload = $request->safe()->only([
            'razon_social',
            'rif',
            'anio_fundacion',
            'capital_social',
            'pagina_web',
            'actividad_id',
            'relacion_comercio_exterior',
            'correo',
            'siglas'
        ]);

        $data_user = $request->safe()->only([
            'name',
            'email',
            'password'
        ]);

        $confirmation_code = $request->input('confirmation_code');
        $solicitud = SolicitudAfiliado::where('confirmation_code', $confirmation_code)->first();

        if(!$solicitud) { return abort(400); }

        DB::beginTransaction();
        try {
            $user = User::create([
                'name'      => $data_user['name'],
                'email'     => $data_user['email'],
                'password'  => bcrypt($data_user['password']),
            ]);

            $afiliado_role = Role::firstOrCreate(['name' => 'afiliado']);
            $user->roles()->sync($afiliado_role);

            # upload image
            $path = $request->file('brand')->store('public/brands');
            $payload['brand'] = $path;

            # upload files
            $rifDocumentFile = $request->file('rif_path');
            $rifDocumentFileName = $rifDocumentFile->hashName();
            $rifDocumentFile->storeAs('afiliados', $rifDocumentFileName);
            $payload['rif_path'] = $rifDocumentFileName;

            $registroMercantilFile = $request->file('registro_mercantil_path');
            $registroMercantilFileName = $registroMercantilFile->hashName();
            $registroMercantilFile->storeAs('afiliados', $registroMercantilFileName);
            $payload['registro_mercantil_path'] = $registroMercantilFileName;

            $estadoFinanciero = $request->file('estado_financiero_path');
            $estadoFinancieroName = $estadoFinanciero->hashName();
            $estadoFinanciero->storeAs('afiliados', $estadoFinancieroName);
            $payload['estado_financiero_path'] = $estadoFinancieroName;

            $afiliado = $user->afiliado()->create($payload);

            $afiliado->direccion()->create($request->safe()->only([
                'direccion_oficina',
                'ciudad_oficina',
                'telefono_oficina',
                'direccion_planta',
                'ciudad_planta',
                'telefono_planta'
            ]));

            $afiliado->personal()->create($request->safe()->only([
                'correo_presidente',
                'correo_gerente_general',
                'correo_gerente_compras',
                'correo_gerente_marketing_ventas',
                'correo_gerente_planta',
                'correo_gerente_recursos_humanos',
                'correo_administrador',
                'correo_gerente_exportaciones',
                'correo_representante_avipla',
                'numero_encargado_ws'
            ]));

            $data_productos = $request->safe()->only([
                'productos',
                'produccion_total_mensual',
                'porcentage_exportacion',
                'mercado_exportacion'
            ]);

            foreach ($data_productos['productos'] as $key => $producto_id) {
                if(!is_numeric($producto_id)) {
                    $producto = Producto::create(['nombre' => $producto_id]);
                    $producto_id = $producto->id;
                }

                $pivot_data[$producto_id] = [
                    'produccion_total_mensual'  => $data_productos['produccion_total_mensual'][$key],
                    'porcentage_exportacion'    => $data_productos['porcentage_exportacion'][$key],
                    'mercado_exportacion'       => $data_productos['mercado_exportacion'][$key]
                ];
            }
            $afiliado->productos()->attach($pivot_data);

            foreach($request->input('servicios') as $servicio) {
                if(is_numeric($servicio)) {
                    $afiliado->servicios()->attach($servicio);
                } else {
                    $newServicio = Servicio::create(['nombre_servicio' => $servicio]);
                    $afiliado->servicios()->attach($newServicio->id);
                }
            }

            foreach($request->input('materias_primas') as $materia) {
                if(is_numeric($materia)) {
                    $afiliado->materias_primas()->attach($materia);
                } else {
                    $newMateria = MateriaPrima::create(['materia_prima' => $servicio]);
                    $afiliado->materias_primas()->attach($newMateria->id);
                }
            }
            $afiliado->referencias()->attach($request->input('afiliados'));

            // and last but not less important
            $solicitud->afiliado_id = $afiliado->id;
            $solicitud->confirmation_code = null;
            $solicitud->save();

            DB::commit();

            Auth::login($user);

            return redirect()->intended('dashboard')->with('success', 'Bienvenido ' . $user->name . '!');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Error al crear la cuenta.');
        }
    }

    public function logout(Request $request) {
        Auth::logout();
 
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();

        return redirect()->route('auth.loginForm');
    }

    public function sendPasswordEmail(Request $request) {
        $request->validate(['email' => 'required|email']);
 
        $status = Password::sendResetLink(
            $request->only('email')
        );
    
        return $status === Password::RESET_LINK_SENT
            ? back()->with(['success' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }

    public function resetPasswordForm(string $token)
    {
        return view('auth.reset-password', ['token' => $token]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);
     
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));
     
                $user->save();
     
                event(new PasswordReset($user));
            }
        );
     
        return $status === Password::PASSWORD_RESET
                    ? redirect()->route('auth.login')->with('success', __($status))
                    : back()->withErrors(['email' => [__($status)]]);
    }
}
