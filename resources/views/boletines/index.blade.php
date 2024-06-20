@extends('layouts.dashboard')
@section('title', 'Boletines')
@section('content')
  <h1 class="mt-4">Boletines</h1>
  <ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Boletines</li>
  </ol>
  @can('create', App\Models\Boletin::class)
    <div class="mb-4">
      <a href="{{ route('boletines.create') }}" class="btn btn-primary">Crear Boletin</a>
    </div>
  @endcan
@endsection