@extends('layouts.dashboard')
@section('title', 'Crear Categoría')
@section('content')
  <h1 class="mt-4 fs-4">Crear Usuario</h1>
  <ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Usuarios</a></li>
    <li class="breadcrumb-item active">Crear Usuario</li>
  </ol>

  <form action="{{ route('users.store') }}" method="POST">
    @csrf
    <div class="card mb-4">
      <div class="card-body">
        @include('users.form')
        <button type="submit" class="btn btn-primary">Crear usuario</button>
      </div>
    </div>
  </form>
@endsection