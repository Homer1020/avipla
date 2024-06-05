@extends('layouts.dashboard')
@section('title', 'Detalle de ' . $afiliado->razon_social)
@section('content')
  <h1 class="mt-4">Detalle de {{ $afiliado->razon_social }}</h1>
  <ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('afiliados.index') }}">Afiliados</a></li>
    <li class="breadcrumb-item active">Detalle</li>
  </ol>

  <ul class="list-group">
    <li class="list-group-item">
      <span class="fw-bold">Razón social: </span>
      {{ $afiliado->razon_social }}
    </li>
    <li class="list-group-item">
      <span class="fw-bold">RIF: </span>
      {{ $afiliado->rif }}
    </li>
    <li class="list-group-item">
      <span class="fw-bold">Direccións: </span>
      {{ $afiliado->direccion }}
    </li>
    <li class="list-group-item">
      <span class="fw-bold">Página web: </span>
      <a href="{{ $afiliado->pagina_web }}">{{ $afiliado->pagina_web }}</a>
    </li>
    <li class="list-group-item">
      <span class="fw-bold">Correo: </span>
      <a href="mailto:{{ $afiliado->correo }}">{{ $afiliado->correo }}</a>
    </li>
    <li class="list-group-item">
      <span class="fw-bold">Teléfono: </span>
      <a href="tel:{{ $afiliado->telefono }}">{{ $afiliado->telefono }}</a>
    </li>
    <li class="list-group-item">
      <span class="fw-bold">Estado: </span>
      @if ($afiliado->estado)
        <span class="badge bg-success">Activo</span>
      @else
        <span class="badge bg-success">Inactivo</span>
      @endif
    </li>
  </ul>
@endsection