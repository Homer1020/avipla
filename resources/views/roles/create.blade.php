@extends('layouts.dashboard')
@section('title', 'Crear rol')
@section('content')
  <h1 class="mt-4 fs-4">
    <i class="fas fa-briefcase fa-sm"></i>
    Crear rol
  </h1>
  <ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">Roles</a></li>
    <li class="breadcrumb-item active">Crear rol</li>
  </ol>
  <div>
    <div class="row justify-content-center">
      <form action="{{ route('roles.store') }}" method="POST">
        @include('roles.form')
      </form>
    </div>
  </div>
@endsection