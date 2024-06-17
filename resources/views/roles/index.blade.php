@extends('layouts.dashboard')
@section('title', 'Roles')
@section('content')
  <h1 class="mt-4">Roles</h1>
  <ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Roles</li>
  </ol>
  <div class="mb-4">
    <a href="{{ route('users.create') }}" class="btn btn-primary">Crear role</a>
  </div>
@endsection