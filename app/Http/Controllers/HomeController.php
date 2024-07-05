<?php

namespace App\Http\Controllers;

use App\Models\Carousel;
use App\Models\Category;
use App\Models\Noticia;

class HomeController extends Controller
{
    public function home() {
        $noticias = Noticia::latest()->limit(3)->get();
        $carousels = Carousel::all();
        return view('home', compact('noticias', 'carousels'));
    }

    public function aboutus() {
        return view('aboutus');
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
}
