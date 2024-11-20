@extends('layouts.main')
@section('title', 'Directorio')
@section('meta_description', 'Explora el directorio de afiliados de la Asociación Venezolana de Plástico. Encuentra empresas y profesionales dedicados al desarrollo y la innovación en la industria del plástico en Venezuela.')
@section('meta_keywords', 'directorio de afiliados, asociación venezolana de plástico, afiliados, empresas de plástico, profesionales del plástico, Venezuela, búsqueda de afiliados')
@section('content')
    <div class="header-separator"></div>

    <section class="section">
      <div class="container-md">
        <h1 class="section__title">Directorio</h1>
        <form class="d-flex mb-3" method="GET">
          <input type="text" class="form-control me-3" placeholder="Buscar..." name="search"  value="{{ request()->query('search') }}">
          <input class="btn btn-primary" type="submit" value="Buscar">
        </form>


        @forelse ($afiliados as $afiliado)
          <div class="card mb-3 border-primary">
            <div class="card-body">
              <p class="text-primary">{{ $afiliado->razon_social }}</p>
              <ul class="list ps-4 text-primary mb-0">
                <li>
                  <i class="fa fa-phone me-1"></i>
                  {{ $afiliado->direccion->telefono_oficina }}
                </li>
                @if($afiliado->user)
                  <li>
                    <i class="fa fa-envelope me-1"></i>
                    {{ $afiliado->user->email }}
                  </li>
                @endif
                <li>
                  <i class="fa fa-map-marker-alt me-1"></i>
                  {{ $afiliado->direccion->direccion_oficina }}
                </li>
              </ul>
            </div>
          </div>
        @empty
          <div class="alert alert-info">
            No hay registros que coincidan
          </div>
        @endforelse

        {{ $afiliados->appends(request()->input())->links() }}
      </div>
    </section>
    <!-- /section -->
@endsection