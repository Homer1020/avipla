<?php

namespace App\Http\Controllers;

use App\Models\Afiliado;
use App\Models\Carousel;
use App\Models\Category;
use App\Models\JuntaDirectiva;
use App\Models\Noticia;
use App\Models\Organismo;
use App\Models\SocialNetwork;
use App\Models\Tag;
use Illuminate\Support\Facades\View;
use Illuminate\Database\Eloquent\Builder;

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
        $search = request()->query('search');
        $afiliados = Afiliado::with('direccion')
            ->latest()
            ->where('razon_social', 'LIKE', '%' . $search . '%')
            ->orWhereHas('direccion', function (Builder $query) use ($search) {
                $query->whereAny([
                    'direccion_oficina',
                    'ciudad_oficina',
                    'telefono_oficina',
                    'direccion_planta',
                    'ciudad_planta',
                    'telefono_planta'
                ], 'LIKE', '%' . $search . '%');
            })
            ->paginate(5);
        return view('directory', compact('afiliados'));
    }

    public function category(Category $category) {
        $noticias = Noticia::with('categoria')
            ->where('estatus', 'PUBLISHED')
            ->whereHas('categoria', function (Builder $query) use ($category) {
                $query->where('id', $category->id);
            })
            ->latest()
            ->paginate(6);
        return view('categorias.show', compact('noticias', 'category'));
    }

    public function tag(Tag $tag) {
        $noticias = Noticia::with('categoria')
            ->where('estatus', 'PUBLISHED')
            ->whereHas('tags', function (Builder $query) use ($tag) {
                $query->where('id', $tag->id);
            })
            ->latest()
            ->paginate(6);
        return view('tags.show', compact('noticias', 'tag'));
    }
}
