<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAfiliadoRequest;
use App\Mail\VerifyAfiliadoEmail;
use App\Models\Actividad;
use App\Models\Afiliado;
use App\Models\MateriaPrima;
use App\Models\Producto;
use App\Models\Servicio;
use App\Models\SolicitudAfiliado;
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
        $solicitudes = SolicitudAfiliado::with('afiliado')->latest()->get();
        return view('afiliados.index', compact('solicitudes'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Afiliado $afiliado)
    {
        $afiliado->load([
            'user',
            'invoices',
            'direccion',
            'productos',
            'materias_primas',
            'servicios',
            'referencias',
            'personal',
            'actividad'
        ]);
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

    public function requestForm() {
        return view('afiliados.request');
    }

    public function request(Request $request) {
        $payload = $request->validate([
            'razon_social'  => 'required|string',
            'correo'        => 'required|email|unique:solicitudes_afiliados,correo'
        ]);

        $confirmation_code = Str::random(25);
        $payload['confirmation_code'] = $confirmation_code;

        $solicitud = SolicitudAfiliado::create($payload);

        Mail::to($request->input('correo'))->send(new VerifyAfiliadoEmail($solicitud));

        return redirect()->route('afiliados.index')->with('success', 'Se envio un correo de acceso.');
    }
}
