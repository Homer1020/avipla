@extends('layouts.dashboard')
@section('title', 'Notificaciones')
@section('content')
  <h1 class="mt-4">Notificaciones</h1>
  <ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Notificaciones</li>
  </ol>
  <div class="mb-4">
    <a href="#" class="btn btn-primary">Crear notificación</a>
  </div>
@endsection