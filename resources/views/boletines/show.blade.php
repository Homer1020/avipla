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
        
    </div>
  </div>
@endsection