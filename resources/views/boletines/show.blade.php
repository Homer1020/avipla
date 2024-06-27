@extends('layouts.dashboard')
@section('title', $boletine->titulo)
@section('content')
    <h1 class="mt-4">{{ $boletine->titulo }}</h1>
  <ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('boletines.index') }}">Boletines</a></li>
    <li class="breadcrumb-item active">{{ $boletine->titulo }}</li>
  </ol>
  <div class="card mb-4">
    <div class="card-body">
      <p class="mb-1"><span class="fw-bold">Por: </span> {{ $boletine->user->name }}</p>
      <p class="mb-1"><span class="fw-bold">Subido: </span> {{ $boletine->created_at->diffForhumans() }}</p>
      <p><span class="fw-bold">Categoria: </span> {{ $boletine->categoria->display_name }}</p>
      {!! $boletine->contenido !!}
    </div>
  </div>
@endsection