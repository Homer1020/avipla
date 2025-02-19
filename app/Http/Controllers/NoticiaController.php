<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Noticia;
use App\Models\Tag;
use App\Models\User;
use App\Rules\FamilyImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class NoticiaController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Noticia::class, 'noticia');
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $noticias = Noticia::with(['categoria', 'usuario', 'comments.user'])->latest()->get();
        return view('noticias.index', compact('noticias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categorias = Category::all();
        $etiquetas = Tag::all();
        return view('noticias.create', compact('categorias', 'etiquetas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $payload = $request->validate([
            'titulo'        => 'required|string|unique:noticias,titulo',
            'contenido'     => 'required|string',
            'categoria_id'  => 'nullable',
            'thumbnail'     => ['required', 'file', 'image', 'mimes:jpeg,jpg,png', 'max:2048', new FamilyImage]
        ]);

        if($request->input('save_draft')) {
            $payload['estatus'] = 'DRAFT';
        }

        $slug = Str::slug($request->input('titulo'), "-");
        $payload['slug'] = $slug;

        $path = $request->file('thumbnail')->store('public/noticias');
        $payload['thumbnail'] = $path;

        $auth_user = Auth::user();

        if($auth_user !== null && $auth_user instanceof User) {
            $noticia = $auth_user->noticias()->create($payload);
            $noticia->tags()->attach($request->input('tags'));
        }

        return redirect()->route('noticias.index')->with('success', 'Se creó la noticia correctamente.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Noticia $noticia)
    {
        $categorias = Category::all();
        $etiquetas = Tag::all();
        return view('noticias.edit', compact('noticia', 'categorias', 'etiquetas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Noticia $noticia)
    {
        $payload = $request->validate([
            'titulo'        => 'required|string|unique:noticias,titulo,' . $noticia->id,
            'contenido'     => 'required|string',
            'categoria_id'  => 'nullable',
            'thumbnail'     => ['file', 'image', 'mimes:jpeg,jpg,png', 'max:2048', new FamilyImage]
        ]);

        if($request->hasFile('thumbnail') && Storage::fileExists($noticia->thumbnail)) {
            Storage::delete($noticia->thumbnail);
            $path = $request->file('thumbnail')->store('public/noticias');
            $payload['thumbnail'] = $path;
        }

        if($request->input('save_draft')) {
            $payload['estatus'] = 'DRAFT';
        } else {
            $payload['estatus'] = 'PUBLISHED';
        }

        $slug = Str::slug($request->input('titulo'), "-");
        $payload['slug'] = $slug;

        $noticia->update($payload);
        $noticia->tags()->sync($request->input('tags'));

        return redirect()->route('noticias.index')->with('success', 'Se actualizó la noticia correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Noticia $noticia)
    {
        if(Storage::fileExists($noticia->thumbnail)) {
            Storage::delete($noticia->thumbnail);
        }

        $noticia->delete();

        return redirect()->route('noticias.index')->with('success', 'Se eliminó la noticia correctamente.');
    }
}
