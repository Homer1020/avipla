@extends('layouts.main')
@section('title', $noticia->titulo)
<style>
    .hero {
        aspect-ratio: 16/8;
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
    }

    .thumbnail {
        aspect-ratio: 16/9;
        object-fit: cover;
    }
</style>
@section('content')
    <div class="header-separator"></div>
    <main class="container py-5">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-8">
                <div class="hero mb-3 rounded" style="background-image: url({{ Storage::url($noticia->thumbnail) }});"></div>
                <ul>
                    <li>Creado por: {{ $noticia->usuario->name }}</li>
                    <li>Publicado el: {{ $noticia->created_at->format('d-m-Y') }}</li>
                    <li>Categorias: {{ $noticia->categoria->name }}</li>
                </ul>
                {!! $noticia->contenido !!}
            </div>
            <div class="col-12 col-lg-4">
                <aside>
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <img class="rounded thumbnail" src="{{ Storage::url($noticia->thumbnail) }}" width="130" alt="...">
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h3 class="fs-5">{{ $noticia->titulo }}</h3>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </main>
@endsection