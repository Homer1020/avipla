<?php

namespace App\Http\Controllers;

use App\Models\Boletine;
use App\Models\CategoriaBoletine;
use App\Models\User;
use App\Notifications\BoletinCreated;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BoletineController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Boletine::class, 'boletine');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $boletines = Boletine::with('categoria')->latest()->get();
        return view('boletines.index', compact('boletines'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categorias = CategoriaBoletine::all();
        $boletine = new Boletine();
        return view('boletines.create', compact('categorias', 'boletine'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $payload = $request->validate([
            'titulo'        => 'required|string|unique:boletines,titulo',
            'contenido'     => 'required|string',
            'category_id'   => 'nullable|exists:categoria_boletines,id'
        ]);

        $slug = Str::slug($request->input('titulo'), "-");
        $payload['slug'] = $slug;

        $boletine = $request->user()->boletin()->create($payload);

        $afiliados = User::whereHas('roles', function ($query) {
            $query->where('name', 'afiliado');
        })
        ->get();
        foreach ($afiliados as $afiliado) {
            $afiliado->notify(new BoletinCreated($boletine));
        }

        return redirect()->route('boletines.index')->with('success', 'Se creó el boletin correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Boletine $boletine)
    {
        $boletine->load('user');
        return view('boletines.show', compact('boletine'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Boletine $boletine)
    {
        $categorias = CategoriaBoletine::all();
        return view('boletines.edit', compact('boletine', 'categorias'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Boletine $boletine)
    {
        $payload = $request->validate([
            'titulo'        => 'required|string|unique:boletines,titulo,' . $boletine->id,
            'contenido'     => 'required|string',
            'category_id'   => 'nullable|exists:categoria_boletines,id'
        ]);

        $slug = Str::slug($request->input('titulo'), "-");
        $payload['slug'] = $slug;

        $boletine->update($payload);

        return redirect()->route('boletines.index')->with('success', 'Se actualizó el boletin correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Boletine $boletine)
    {
        $boletine->delete();
        return redirect()->route('boletines.index')->with('success', 'Se eliminó el boletin correctamente');
    }
}
