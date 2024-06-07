<?php

namespace App\Http\Controllers;

use App\Mail\VerifyAfiliadoEmail;
use App\Models\Afiliado;
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
        return view('afiliados.create', ['afiliado' => new Afiliado()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $payload = $request->validate([
            'razon_social'  => 'required|string',
            'rif'           => 'required|unique:afiliados,rif',
            'pagina_web'    => 'url|nullable',
            'direccion'     => 'string|nullable',
            'telefono'      => 'string|nullable',
            'correo'        => 'email|required|unique:afiliados,correo'
        ]);

        $confirmation_code = Str::random(25);
        $payload['confirmation_code'] = $confirmation_code;

        $afiliado = Afiliado::create($payload);

        /**
         * TODO: hacer que se genere un codigo de confirmacion y enviarlo por email.
         */
        Mail::to($payload['correo'])->send(new VerifyAfiliadoEmail($afiliado));

        return redirect()->route('afiliados.index')->with('succes', 'Se envio un correo al afiliado para crear la cuenta.');
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
        return view('afiliados.edit', compact('afiliado'));
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
