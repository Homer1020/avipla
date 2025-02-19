@extends('layouts.main')
@section('title', 'Inicio')
@push('css')
    <style>
        body {
            background-color: #f5f5f5;
        }
    </style>
@endpush
@section('content')
	<!-- carousel -->
	<div class="owl-carousel">
        @forelse ($carousels as $carousel)
            <div>
                <div class="banner" style="background-image: url({{ Storage::url($carousel->imagen) }});">
                    <div class="container-sm h-100">
                        <div class="row h-100 align-items-center">
                            <div class="col-lg-6">
                                <h1 class="banner__title text-center text-lg-start">{{ $carousel->titulo }}</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div>
                <div class="banner" style="background-image: url(./assets/img/hands.jpg);">
                    <div class="container-sm h-100">
                        <div class="row h-100 align-items-center">
                            <div class="col-lg-6">
                                <h1 class="banner__title text-center text-lg-start">Asociación Venezolana de industrias plásticas</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforelse
	</div>
    <!-- /carousel -->

  <!-- section -->
  <section class="section pb-0">
    <div class="container-sm">
        <h2 class="section__title">¿Qué es AVIPLA?</h2>
        <div class="row">
            <div class="col-md-6 mb-4 mb-md-0">
                <img src="./assets/img/botellas.jpg" alt="Botellas" class="rounded img-fluid h-100 object-fit-cover shadow-sm">
            </div>
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <p class="card-text">La asociación venezolana de industrias plásticas ha sido desde 1965 una organización que reúne y representa a las empresas del Sector Plástico, dedicada a promover e impulsar el desarrollo de la industria plástica a nivel Nacional.</p>
                        <ul class="mb-4">
                            <li class="mb-3">Fortalecer las alianzas de las industrias que representa, en especial las alianzas de sus empresas afiliadas, a fin de lograr la protección de los intereses de las industrias en el marco de la ley.</li>
                            <li class="mb-3"> Establecer relaciones con todas las organizaciones representativas de la producción nacional, cuya cooperación redunde en beneficio de los intereses del movimiento industrial.</li>
                            <li class="mb-3">Promover el aumento del consumo de productos plásticos de producción nacional en todo el país y esforzarse por informar, educar y promover la mejora continua de los productos plásticos.</li>
                        </ul>
                        <a href="{{ route('about') }}" class="btn btn-outline-primary">Saber más</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /section -->

<!-- section -->
<section class="section">
    <div class="container-sm">
        <h2 class="section__title">Noticias de la Industria</h2>
        <div class="row">
            @foreach ($noticias as $noticia)
                <div class="col-md-4">
                    <article class="mb-5 mb-md-0">
                        <a href="{{ route('news.item', $noticia) }}" class="d-block">
                            <img style="aspect-ratio: 1280/853;" src="{{ Storage::url($noticia->thumbnail) }}" class="figure-img w-100 rounded shadow-sm object-fit-cover d-block mb-3" alt="{{ $noticia->titulo }}">
                        </a>
                        <h3 class="fs-5 article__title mb-3"><a class="text-primary" href="{{ route('news.item', $noticia) }}">{{ $noticia->titulo }}</a></h3>

                        <a href="{{ route('news.item', $noticia) }}" class="btn btn-outline-primary">Leer artículo</a>
                    </article>
                </div>
            @endforeach
            <div class="col-12 text-center" style="margin-top: 4rem;">
                <a href="{{ route('news') }}" class="btn btn-primary text-uppercase">Ver más</a>
            </div>
        </div>
    </div>
</section>
<!-- /section -->

<!-- section -->
<section class="section section--with-decoration bg-secondary text-white">
    <div class="container-sm">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h2 class="section__title text-white mb-4">Afiliados</h2>
                <p class="mb-4">AVIPLA agrupa dentro de sus afiliados a gran parte de la cadena del sector plástico; desde fabricantes y distribuidores de materias primas, distribuidores de maquinaria y equipos, fabricantes y distribuidores transformadores de plástico en todas las modalidades. Consulte nuestros afiliados.</p>
                <h3 class="section__subtitle mb-4">Colsulte nuestros afiliados</h3>
                <a href="{{ route('directory') }}" class="btn btn-outline-light me-2">
                    <i class="fa fa-address-book"></i>
                    Ver directorio
                </a>
                <a href="{{ route('contact') }}" class="btn btn-light">
                    <i class="fa fa-pen"></i>
                    Afiliate
                </a>
            </div>
            <div class="col-md-6">
            </div>
        </div>
    </div>
</section>
<!-- /section -->

<!-- section -->
<section class="section">
    <div class="container-sm">
        <h2 class="section__title">Organismos y representaciones</h2>
        <div class="row align-items-center">
            @foreach ($organismos as $organismo)
                <div class="col-md-3 mb-5 mb-md-0 text-center">
                    <img src="{{ Storage::url($organismo->logotipo) }}" alt="Logo {{ $organismo->razon_social }}" class="img-fluid" width="150">
                </div>
            @endforeach
        </div>
    </div>
</section>
<!-- /section -->
@endsection