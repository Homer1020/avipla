@extends('layouts.main')
@section('title', 'Noticias')
@push('css')
    <style>
        .hero {
            height: 300px;
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            position: relative;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: linear-gradient(
                to bottom,
                rgba(50, 53, 103, .5),
                rgba(50, 53, 103, .9)
            );
        }

        .hero > * {
            position: relative;
            z-index: 1;
        }

        body {
            background-color: #f5f5f5;
        }

        .card-img-top {
            aspect-ratio: 15/9;
            object-fit: cover;
        }

        #header .navbar-brand img {
            width: 90px;
        }

        .header-separator {
            height: 100px;
        }
    </style>
@endpush
@section('content')
<section>
    <div class="header-separator"></div>
    <div class="hero mb-5 d-flex align-items-center" style="background-image: url(/assets/img/botellas3.jpg)">
        <div class="container">
            <h1 class="text-white text-uppercase fs-1 fw-bold">Noticias recientes</h1>
        </div>
    </div>
    <div class="container py-3">
        <div class="row">
            @foreach ($noticias as $noticia)
                <div class="col-md-4">
                    <article class="mb-5">
                        <a href="{{ route('news.item', $noticia) }}" class="d-block">
                            <img style="aspect-ratio: 1280/853;" src="{{ Storage::url($noticia->thumbnail) }}" class="figure-img img-fluid rounded shadow-sm object-fit-cover d-block mb-3" alt="{{ $noticia->titulo }}">
                        </a>
                        <h3 class="fs-5 article__title mb-3"><a class="text-primary" href="{{ route('news.item', $noticia) }}">{{ $noticia->titulo }}</a></h3>

                        <a href="{{ route('news.item', $noticia) }}" class="btn btn-outline-primary">Leer artículo</a>
                    </article>
                </div>
            @endforeach
            
            {{ $noticias->links() }}
        </div>
    </div>
</section>
@endsection