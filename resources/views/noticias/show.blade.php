@extends('layouts.main')
@section('title', $noticia->titulo)
@push('css')
    <style>
        body {
            background-color: #f5f5f5;
        }

        .hero {
            aspect-ratio: 16/8;
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

        .thumbnail {
            aspect-ratio: 16/10;
            object-fit: cover;
        }

        #header {
            background-color: rgba(255, 255, 255, 1);
        }

        #header .navbar-brand img {
            width: 90px;
        }

        .header-separator {
            height: 100px;
        }

        .metadata {
            display: flex;
            margin: 0;
            padding: 0;
            list-style: none;
            font-size: 14px;
        }

        .metadata li:not(:last-child) {
            margin-right: .7rem;
            padding-right: .7rem;
            border-right: 1px solid rgba(0, 0, 0, .2);
        }

        .fw-bold,
        h1,
        h2,
        h3,
        h4 {
            color: #000;
        }
    </style>
@endpush
@section('content')
    <div class="header-separator"></div>
    <main class="container py-3">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-8">
                <div class="hero mb-3 rounded d-flex align-items-end pb-2 ps-4 m-0" style="background-image: url({{ Storage::url($noticia->thumbnail) }});">
                    <h1 class="text-white text-uppercase fs-2">{{ $noticia->titulo }}</h1>
                </div>
                <ul class="metadata mb-3">
                    <li>
                        <span class="me-1">
                            <i class="fa fa-user"></i>
                        </span>
                        <span>
                            {{ $noticia->usuario->name }}
                        </span>
                    </li>
                    <li>
                        <span class="me-1">
                            <i class="fa fa-calendar-alt"></i>
                        </span>
                        {{ $noticia->created_at->format('d-m-Y') }}
                    </li>
                    @if ($noticia->categoria)
                        <li>
                            <span class="me-1">
                                <i class="fa fa-tag"></i>
                            </span>
                            <a href="{{ route('category.show', $noticia->categoria) }}" class="link link-primary">{{ $noticia->categoria->name }}</a>
                        </li>
                    @endif
                    <li>
                        <span class="me-1">
                            <i class="fa fa-tags"></i>
                        </span>
                        @foreach ($noticia->tags as $tag)
                            <a href="{{ route('tags.show', $tag) }}" class="link link-primary">{{ $tag->display_name }}</a>{{ $noticia->tags->last()->id !== $tag->id ? ', ' : '' }}
                        @endforeach
                    </li>
                </ul>
                {!! $noticia->contenido !!}

                <div class="card card-body border mb-3">
                    <form action="{{ route('comments.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="noticia_id" value="{{ $noticia->id }}">

                        <div class="mb-3">
                            <label for="content" class="form-label">Comentario</label>
                            <textarea name="content" placeholder="Excelente publicación" id="content" rows="5" class="form-control"></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary btn-sm">
                            <i class="fa fa-message"></i>
                            Guardar
                        </button>
                    </form>
                </div>

                <div class="card card-body border mb-3">
                    <h4 class="mb-4">Todos los comentarios</h4>
                    @foreach ($noticia->comments as $comment)
                        <div class="d-flex border-bottom mb-3 pb-3">
                            <div class="flex-shrink-0">
                                @if ($comment->user->afiliado && $comment->user->afiliado->brand)
                                    <img src="{{ Storage::url($comment->user->afiliado->brand) }}" alt="Avatar" width="50">
                                @else
                                    <img src="{{ asset('assets/img/avatar.jpg') }}" alt="Avatar" width="50">
                                @endif
                            </div>
                            <div class="flex-grow-1 ms-3">
                                @if ($comment->user->afiliado)
                                    <h6 class="fw-bold mb-0">{{ $comment->user->afiliado->razon_social }}</h5>
                                @else
                                    <h6 class="fw-bold mb-0">{{ $comment->user->name }}</h5>
                                @endif
                                <p class="text-muted mb-0">{{ $comment->user->email }}</p>
                                <p class="text-muted mb-1" style="font-size: 14px;">{{ $comment->created_at->diffForHumans() }}</p>
                                <p class="m-0">{{ $comment->content }}</p>
                                <div class="mt-2 d-flex gap-2">
                                    @can('delete', $comment)
                                        <form action="{{ route('comments.destroy', $comment) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-sm btn btn-danger btn-comment">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    @endcan

                                    @can('update', $comment)
                                        <button type="submit" class="btn-sm btn btn-warning btn-comment">
                                            <i class="fa fa-pencil"></i>
                                        </button>
                                    @endcan
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-12 col-lg-4">
                <aside>
                    <div class="card shadow-sm mb-4">
                        <div class="card-body">
                            <section class="mb-4">
                                <h2 class="h6 fw-bold card-title mb-3 text-primary text-uppercase">Noticias relacionadas</h2>
                                @forelse ($relacionadas as $relacionada)
                                    <article class="d-flex mb-3">
                                        <div class="flex-shrink-0">
                                            <a href="{{ route('news.item', $relacionada) }}">
                                                <img class="rounded thumbnail" src="{{ Storage::url($relacionada->thumbnail) }}" width="100" alt="...">
                                            </a>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h3 class="fs-6 fw-bold mb-0 text-primary">
                                                <a href="{{ route('news.item', $relacionada) }}" style="text-decoration: none;">
                                                    {{ $relacionada->titulo }}
                                                </a>
                                            </h3>
                                            <p class="m-0">
                                                <small><span class="fw-bold">Por:</span> {{ $relacionada->usuario->name }}</small>
                                            </p>
                                        </div>
                                    </article>
                                @empty
                                    <div class="alert alert-info">
                                        No hay publicaciones relacionadas.
                                    </div>
                                @endforelse
                            </section>
                            <section>
                                <h2 class="h6 fw-bold card-title mb-3 text-primary text-uppercase">Categorías</h2>
                                <ul>
                                    @foreach ($categorias as $categoria)
                                        <li>
                                            <a href="{{ route('category.show', $categoria) }}" class="link link-primary" style="text-decoration: none;">{{ $categoria->name }} ({{ $categoria->noticias->count() }})</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </section>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </main>
@endsection