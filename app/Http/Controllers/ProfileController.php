<?php

namespace App\Http\Controllers;

use App\Models\Actividad;
use App\Models\Afiliado;
use App\Models\MateriaPrima;
use App\Models\Producto;
use App\Models\Servicio;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class ProfileController extends Controller
{
    public function show() {
        $user = request()->user();
        $user->load(['afiliado', 'roles']);

        return view('profile.show', compact('user'));
    }

    public function showPresidente() {
        request()->user()->load('afiliado');
        $afiliado = request()->user()->afiliado;

        $presidente = $afiliado->presidente ? $afiliado->presidente : new User();
        return view('profile.presidente', compact('presidente'));
    }

    public function showDirector() {
        request()->user()->load('afiliado');
        $afiliado = request()->user()->afiliado;

        $director = $afiliado->director ? $afiliado->director : new User();
        return view('profile.director', compact('director'));
    }

    public function storePresidente(Request $request) {
        request()->user()->load(['afiliado', 'roles']);
        $afiliado = request()->user()->afiliado;
        $presidente = $afiliado->presidente;

        if($presidente) {
            $payload = $request->validate([
                'name'      => 'required|string',
                'email'     => 'required|string|email|unique:users,email,' . $presidente->id,
                'password'  => 'nullable|min:8|confirmed'
            ]);
            $presidente->name = $payload['name'];
            $presidente->email = $payload['email'];
            if($request->input('password')) {
                $presidente->password = bcrypt($request->input('password'));
            }
            $presidente->save();
        }else {
            $afiliado_role = Role::where('name', 'afiliado')->get();
            $payload = $request->validate([
                'name'      => 'required|string',
                'email'     => 'required|string|email|unique:users,email',
                'password'  => 'nullable|min:8|confirmed'
            ]);
            $payload['tipo_afiliado'] = 1;
            $presidente = $afiliado->users()->create($payload);
            $presidente->roles()->sync($afiliado_role);
        }

        return redirect()->route('profile.showPresidente')->with('success', 'Se actualizaron los datos del presidente correctamente');
    }

    public function storeDirector(Request $request) {
        request()->user()->load(['afiliado', 'roles']);
        $afiliado = request()->user()->afiliado;
        $director = $afiliado->director;

        if($director) {
            $payload = $request->validate([
                'name'      => 'required|string',
                'email'     => 'required|string|email|unique:users,email,' . $director->id,
                'password'  => 'nullable|min:8|confirmed'
            ]);
            $director->name = $payload['name'];
            $director->email = $payload['email'];
            if($request->input('password')) {
                $director->password = bcrypt($request->input('password'));
            }
            $director->save();
        }else {
            $afiliado_role = Role::where('name', 'afiliado')->get();
            $payload = $request->validate([
                'name'      => 'required|string',
                'email'     => 'required|string|email|unique:users,email',
                'password'  => 'nullable|min:8|confirmed'
            ]);
            $payload['tipo_afiliado'] = 2;
            $director = $afiliado->users()->create($payload);
            $director->roles()->sync($afiliado_role);
        }

        return redirect()->route('profile.showDirector')->with('success', 'Se actualizaron los datos del director ejecutivo correctamente');
    }

    public function update(Request $request) {
        $user = request()->user();

        $payload = $request->validate([
            'name'      => 'required|string',
            'email'     => 'required|string|email|unique:users,email,' . $user->id,
            'password'  => 'nullable|min:8|confirmed'
        ]);


        $user->name = $payload['name'];
        $user->email = $payload['email'];

        if($request->input('password')) {
            $user->password = bcrypt($request->input('password'));
        }

        $user->save();

        return redirect()->route('profile.show')->with('success', 'Se actualizó el perfil correctamente.');
    }

    public function businessShow(Request $request) {
        $afiliado = $request->user()->afiliado;
        // return $afiliado;
        if(!$afiliado) {
            return redirect()->route('dashboard')->with('error', 'No eres un afiliado');
        }
        $actividades = Actividad::all();
        $productos = Producto::all();
        $materias_primas = MateriaPrima::all();
        $servicios = Servicio::all();
        $afiliados = Afiliado::where('id', '!=', $afiliado->id)->get();
        $afiliado->load([
            'direccion',
            'personal',
            'productos',
            'materias_primas',
            'servicios'
        ]);
        return view('profile.business', compact(
            'afiliado',
            'actividades',
            'productos',
            'materias_primas',
            'servicios',
            'afiliados'
        ));
    }
}
