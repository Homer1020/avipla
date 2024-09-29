@extends('layouts.dashboard')
@section('title', 'Crear role')
@section('content')
  <h1 class="mt-4">Crear role</h1>
  <ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">Roles</a></li>
    <li class="breadcrumb-item active">Crear role</li>
  </ol>
  <div>
    <div class="row justify-content-center">
      <form action="{{ route('roles.store') }}" method="POST" class="col-md-8">
        @include('roles.form')
      </form>
    </div>
  </div>
@endsection