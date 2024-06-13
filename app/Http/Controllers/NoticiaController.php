<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Noticia;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class NoticiaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $noticias = Noticia::with(['categoria', 'usuario'])->latest()->get();
        return view('noticias.index', compact('noticias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categorias = Category::all();
        return view('noticias.create', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $payload = $request->validate([
            'titulo'        => 'required|string|unique:noticias,titulo',
            'contenido'     => 'required|string',
            'categoria_id'  => 'required|numeric|exists:categories,id',
            'thumbnail'     => 'required|file'
        ]);

        $slug = Str::slug($request->input('titulo'), "-");
        $payload['slug'] = $slug;

        $path = $request->file('thumbnail')->store('public/noticias');
        $payload['thumbnail'] = $path;

        $auth_user = Auth::user();

        if($auth_user !== null && $auth_user instanceof User) {
            $auth_user->noticias()->create($payload);
        }


        return redirect()->route('noticias.index')->with('success', 'Se creo la noticia correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Noticia $noticia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Noticia $noticia)
    {
        $categorias = Category::all();
        return view('noticias.edit', compact('noticia', 'categorias'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Noticia $noticia)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Noticia $noticia)
    {
        //
    }
}
