@extends('layouts.dashboard')
@section('title', 'Crear Afiliado')
@section('content')
  <h1 class="mt-4">Crear Afiliado</h1>
  <ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('afiliados.index') }}">Afiliados</a></li>
    <li class="breadcrumb-item active">Crear Afiliado</li>
  </ol>

  <form action="{{ route('afiliados.store') }}" method="POST">
    @csrf

    <div class="card mb-4">
      <div class="card-body">
        @include('afiliados.form')
        <button type="submit" class="btn btn-primary mt-4">Enviar solicitud</button>
      </div>
    </div>
  </form>
@endsection