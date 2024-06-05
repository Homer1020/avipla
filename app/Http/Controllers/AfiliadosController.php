<?php

namespace App\Http\Controllers;

use App\Models\Afiliado;
use Illuminate\Http\Request;

class AfiliadosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $afiliados = Afiliado::where('estado', true)->latest()->get();
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
            'rif'           => 'required',
            'pagina_web'    => 'url|nullable',
            'correo'        => 'email|unique:afiliados,correo',
            'direccion'     => 'string|nullable',
            'telefono'      => 'string|nullable'
        ]);

        Afiliado::create($payload);

        /**
         * TODO: hacer que se genere un token y enviarlo por email.
         */

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
    public function update(Request $request, string $id)
    {
        //
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
}
