@extends('layouts.main')
@section('title', $noticia->titulo)
@push('css')
    <style>
        .hero {
            aspect-ratio: 16/8;
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
        }

        .thumbnail {
            aspect-ratio: 16/10;
            object-fit: cover;
        }

        #header .navbar-brand img {
            width: 100px;
        }

        .header-separator {
            height: 110px;
        }
    </style>
@endpush
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
                <h1>{{ $noticia->titulo }}</h1>
                {!! $noticia->contenido !!}
            </div>
            <div class="col-12 col-lg-4">
                <aside>
                    <div class="card mb-4">
                        <div class="card-body">
                            @foreach ($relacionadas as $relacionada)
                                <div class="d-flex mb-3">
                                    <div class="flex-shrink-0">
                                        <a href="{{ route('noticias.show', $noticia) }}">
                                            <img class="rounded thumbnail" src="{{ Storage::url($relacionada->thumbnail) }}" width="130" alt="...">
                                        </a>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h3 class="fs-5">
                                            <a href="{{ route('noticias.show', $relacionada) }}">
                                                {{ $relacionada->titulo }}
                                            </a>
                                        </h3>
                                        <p>Por: {{ $relacionada->usuario->name }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </main>
@endsection