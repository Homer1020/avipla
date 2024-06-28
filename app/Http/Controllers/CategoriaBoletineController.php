<?php

namespace App\Http\Controllers;

use App\Models\CategoriaBoletine;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoriaBoletineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categorias = CategoriaBoletine::latest('id')->get();
        return view('categoria_boletines.index', compact('categorias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categoria_boletines.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $payload = $request->validate([
            'display_name'  => 'required|string|unique:categoria_boletines,display_name'
        ]);

        $slug = Str::slug($request->input('display_name'), "-");
        $payload['name'] = $slug;

        CategoriaBoletine::create($payload);

        return redirect()->route('categorias-boletines.index')->with('success', 'Se creó la categoría correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(CategoriaBoletine $categoriaBoletine)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CategoriaBoletine $category)
    {
        return view('categoria_boletines.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CategoriaBoletine $category)
    {
        $payload = $request->validate([
            'display_name'  => 'required|string|unique:categoria_boletines,display_name,' . $category->id
        ]);

        $slug = Str::slug($request->input('display_name'), "-");
        $payload['name'] = $slug;

        $category->update($payload);

        return redirect()->route('categorias-boletines.index')->with('success', 'Se actualizó la categoría correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CategoriaBoletine $category)
    {
        $category->delete();
        return redirect()->route('categorias-boletines.index')->with('success', 'Se eliminó la categoría correctamente.');
    }
}
