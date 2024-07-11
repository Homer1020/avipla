<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TagController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Tag::class, 'tag');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $etiquetas = Tag::all();
        return view('tags.index', compact('etiquetas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tags.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $payload = $request->validate([
            'display_name'  => 'required|string|unique:tags,display_name'
        ]);

        $slug = Str::slug($request->input('display_name'), "-");
        $payload['name'] = $slug;

        Tag::create($payload);

        return redirect()->route('tags.index')->with('success', 'Se creó la etiqueta correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tag $tag)
    {
        return view('tags.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tag $tag)
    {
        $payload = $request->validate([
            'display_name'  => 'required|string|unique:tags,display_name,' . $tag->id
        ]);

        $slug = Str::slug($request->input('display_name'), "-");
        $payload['name'] = $slug;

        $tag->update($payload);

        return redirect()->route('tags.index')->with('success', 'Se actualizó la etiqueta correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        $tag->delete();
        return redirect()->route('tags.index')->with('success', 'Se eliminó la etiqueta correctamente.');
    }
}
