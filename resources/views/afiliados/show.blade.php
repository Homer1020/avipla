@extends('layouts.dashboard')
@section('title', 'Detalle de ' . $afiliado->razon_social)
@section('content')
  <h1 class="mt-4">Detalle de {{ $afiliado->razon_social }}</h1>
  <ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('afiliados.index') }}">Afiliados</a></li>
    <li class="breadcrumb-item active">Detalle</li>
  </ol>

  <div class="row mb-4">
    <div class="col-lg-6">
      <p class="fw-bold text-uppercase text-muted">Datos de la empresa</p>
      <ul class="list-group">
        <li class="list-group-item">
          <span class="fw-bold d-block">Razón social: </span>
          {{ $afiliado->razon_social }}
        </li>
        <li class="list-group-item">
          <span class="fw-bold d-block">RIF: </span>
          {{ $afiliado->rif }}
        </li>
        <li class="list-group-item">
          <span class="fw-bold d-block">Dirección: </span>
          {{ $afiliado->direccion }}
        </li>
        <li class="list-group-item">
          <span class="fw-bold d-block">Página web: </span>
          <a href="{{ $afiliado->pagina_web }}">{{ $afiliado->pagina_web }}</a>
        </li>
        <li class="list-group-item">
          <span class="fw-bold d-block">Correo: </span>
          <a href="mailto:{{ $afiliado->correo }}">{{ $afiliado->correo }}</a>
        </li>
        <li class="list-group-item">
          <span class="fw-bold d-block">Teléfono: </span>
          <a href="tel:{{ $afiliado->telefono }}">{{ $afiliado->telefono }}</a>
        </li>
        <li class="list-group-item">
          <span class="fw-bold d-block">Estado: </span>
          @if ($afiliado->estado)
            <span class="badge bg-success">Activo</span>
          @else
            <span class="badge bg-success">Inactivo</span>
          @endif
        </li>
      </ul>
    </div>
    <div class="col-lg-6">
      <p class="fw-bold text-uppercase text-muted">Datos del encargado</p>
      <ul class="list-group">
        @if($afiliado->user()->exists())
        @php
          $afiliado->load('user');    
        @endphp
          <li class="list-group-item"><span class="fw-bold d-block">Encargado:</span> {{ $afiliado->user->name }}</li>
          <li class="list-group-item"><span class="fw-bold d-block">Correo del encargado:</span> <a href="mailto:{{ $afiliado->user->email }}">{{ $afiliado->user->email }}</a></li>
          <li class="list-group-item">
            <span class="fw-bold d-block">Reenviar codigo de registro:</span>
            <a class="btn btn-success mt-2">
              <i class="fa fa-envelope"></i>
              Enviar correo
            </a>
          </li>
        @else
          <li class="list-group-item">
            <span class="fw-bold d-block">Solicitar registro por correo:</span>
            <a class="btn btn-success mt-2">
              <i class="fa fa-envelope"></i>
              Enviar correo
            </a>
          </li>
        @endif
      </ul>
    </div>
  </div>
@endsection