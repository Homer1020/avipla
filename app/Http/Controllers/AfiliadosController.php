<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAfiliadoRequest;
use App\Mail\VerifyAfiliadoEmail;
use App\Models\Actividad;
use App\Models\Afiliado;
use App\Models\MateriaPrima;
use App\Models\Producto;
use App\Models\Servicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AfiliadosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $afiliados = Afiliado::latest()->where('estado', true)->get();
        return view('afiliados.index', compact('afiliados'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $actividades = Actividad::all();
        $productos = Producto::all();
        $materias_primas = MateriaPrima::all();
        $servicios = Servicio::all();
        $afiliados = Afiliado::all();

        $afiliado = new Afiliado();

        return view('afiliados.create', compact(
            'afiliado',
            'actividades',
            'productos',
            'materias_primas',
            'servicios',
            'afiliados'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAfiliadoRequest $request)
    {
        // return $request->all();
        $payload = $request->safe()->only([
            'razon_social',
            'rif',
            'anio_fundacion',
            'capital_social',
            'pagina_web',
            'actividad_principal',
            'relacion_comercio_exterior',
            'correo',
            'siglas'
        ]);

        $confirmation_code = Str::random(25);
        $payload['confirmation_code'] = $confirmation_code;

        $afiliado = Afiliado::create($payload);

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
            'correo_representante_avipla'
        ]));

        $data_productos = $request->safe()->only([
            'productos',
            'produccion_total_mensual',
            'porcentage_exportacion',
            'mercado_exportacion'
        ]);

        foreach ($data_productos['productos'] as $key => $producto_id) {
            $pivot_data[$producto_id] = [
                'produccion_total_mensual'  => $data_productos['produccion_total_mensual'][$key],
                'porcentage_exportacion'    => $data_productos['porcentage_exportacion'][$key],
                'mercado_exportacion'       => $data_productos['mercado_exportacion'][$key]
            ];
        }

        $afiliado->productos()->attach($pivot_data);
        $afiliado->servicios()->attach($request->input('servicios'));
        $afiliado->materias_primas()->attach($request->input('materias_primas'));
        $afiliado->referencias()->attach($request->input('afiliados'));

        Mail::to($afiliado->correo)->send(new VerifyAfiliadoEmail($afiliado));

        return redirect()->route('afiliados.index')->with('success', 'Se envio un correo al afiliado para crear la cuenta.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Afiliado $afiliado)
    {
        return view('afiliados.show', compact('afiliado'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Afiliado $afiliado)
    {
        $actividades = Actividad::all();
        $productos = Producto::all();
        $materias_primas = MateriaPrima::all();
        $servicios = Servicio::all();
        $afiliados = Afiliado::all();
        $afiliado->load([
            'direccion',
            'personal',
            'productos',
            'materias_primas',
            'servicios'
        ]);
        return view('afiliados.edit', compact(
            'afiliado',
            'actividades',
            'productos',
            'materias_primas',
            'servicios',
            'afiliados'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Afiliado $afiliado)
    {
        $payload = $request->validate([
            'razon_social'  => 'required|string',
            'rif'           => 'required',
            'pagina_web'    => 'url|nullable',
            'correo'        => 'email|unique:afiliados,correo,' . $afiliado->id,
            'direccion'     => 'string|nullable',
            'telefono'      => 'string|nullable'
        ]);

        $afiliado->update($payload);

        /**
         * TODO: hacer que se genere un token y enviarlo por email.
         */

        return redirect()->route('afiliados.index')->with('succes', 'Afiliado actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Afiliado $afiliado)
    {
        $afiliado->update([
            'estado' => false
        ]);

        return redirect()
                ->route('afiliados.index')
                ->with('success', 'Se elimino el afiliado correctamente.');
    }

    public function sendConfirmationEmail(Afiliado $afiliado) {
        $confirmation_code = Str::random(25);

        $afiliado->confirmation_code = $confirmation_code;
        $afiliado->confirmed = false;
        $afiliado->save();
        
        Mail::to($afiliado->correo)->send(new VerifyAfiliadoEmail($afiliado));

        return redirect()->route('afiliados.show', $afiliado)->with('success', 'Se envio un correo de acceso.');
    }
}
