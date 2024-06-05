@extends('layouts.dashboard')
@section('title', 'Modificar Afiliado')
@section('content')
  <h1 class="mt-4">Modificar Afiliado</h1>
  <ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('afiliados.index') }}">Afiliados</a></li>
    <li class="breadcrumb-item active">Modificar afiliado</li>
  </ol>

  <form action="{{ route('afiliados.update', $afiliado) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="card mb-4">
      <div class="card-body">
        @include('afiliados.form')
        <button type="submit" class="btn btn-primary mt-4">Guardar afiliado</button>
      </div>
    </div>
  </form>
@endsection