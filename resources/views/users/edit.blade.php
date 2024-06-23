@extends('layouts.dashboard')
@section('title', 'Editar Categoría')
@section('content')
  <h1 class="mt-4">Editar Usuario</h1>
  <ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Usuarios</a></li>
    <li class="breadcrumb-item active">Editar Usuario</li>
  </ol>

  <form action="{{ route('users.update', $user) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="card mb-4">
      <div class="card-body">
        @include('users.form')
        <button type="submit" class="btn btn-primary">Guardar usuario</button>
      </div>
    </div>
  </form>
@endsection