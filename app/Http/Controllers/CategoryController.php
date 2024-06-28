<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categorias = Category::with('noticias')->get();
        return view('categorias.index', compact('categorias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categorias.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $payload = $request->validate([
            'display_name'  => 'required|string|unique:categories,display_name'
        ]);

        $slug = Str::slug($request->input('display_name'), "-");
        $payload['name'] = $slug;

        Category::create($payload);

        return redirect()->route('categories.index')->with('success', 'Se creó la categoría correctamente.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('categorias.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $payload = $request->validate([
            'display_name'  => 'required|string|unique:categories,display_name,' . $category->id
        ]);

        $slug = Str::slug($request->input('display_name'), "-");
        $payload['name'] = $slug;

        $category->update($payload);

        return redirect()->route('categories.index')->with('success', 'Se actualizó la categoría correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Se eliminó la categoría correctamente.');
    }
}
