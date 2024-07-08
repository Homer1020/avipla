<?php

namespace App\Http\Controllers;

use App\Models\Carousel;
use App\Models\Category;
use App\Models\JuntaDirectiva;
use App\Models\Noticia;
use App\Models\Organismo;
use App\Models\SocialNetwork;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\View;

class HomeController extends Controller
{
    public function __construct()
    {
        $socialNetwork = SocialNetwork::first() ?? new SocialNetwork();
        View::share('socialNetwork', $socialNetwork);
    }

    public function home() {
        $noticias = Noticia::latest()->limit(3)->get();
        $organismos = Organismo::all();
        $carousels = Carousel::all();
        return view('home', compact('noticias', 'carousels', 'organismos'));
    }

    public function aboutus() {
        $organismos = Organismo::all();
        $juntaDirectiva  = JuntaDirectiva::with('role')->get();
        
        $directoresPrincipales = collect($juntaDirectiva)->filter(function ($item) {
            return $item['role']['display_name'] === 'Directores principales';
        })->values();
        
        $directoresSecundarios = collect($juntaDirectiva)->filter(function ($item) {
            return $item['role']['display_name'] === 'Directores secundarios';
        })->values();
        
        $juntaDirectivaPersonal = collect($juntaDirectiva)->reject(function ($item) {
            return $item['role']['display_name'] === 'Directores principales' || $item['role']['display_name'] === 'Directores secundarios';
        })->values();

        return view('aboutus', compact('organismos', 'directoresPrincipales', 'directoresSecundarios', 'juntaDirectivaPersonal'));
    }

    public function services() {
        return view('services');
    }

    public function affiliation() {
        return view('affiliation');
    }

    public function news() {
        $noticias = Noticia::with('categoria')
            ->where('estatus', 'PUBLISHED')
            ->latest()
            ->paginate(6);
        return view('news', compact('noticias'));
    }

    public function contact() {
        return view('contact');
    }

    public function newsItem(Noticia $noticia) {
        if($noticia->estatus === 'DRAFT') {
            return abort(404);
        }
        $noticia->load('tags');
        $relacionadas = Noticia::whereHas('categoria', function ($query) use ($noticia) {
                $query->where('categoria_id', $noticia->categoria_id);
            })
            ->where('id', '!=', $noticia->id)
            ->inRandomOrder()
            ->limit(3)
            ->get();
        $categorias = Category::all();
        return view('noticias.show', compact('noticia', 'relacionadas', 'categorias'));
    }

    public function directory() {
        return view('directory');
    }
}
