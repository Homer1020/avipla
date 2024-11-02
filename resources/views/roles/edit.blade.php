@extends('layouts.dashboard')
@section('title', 'Editar role')
@section('content')
  <h1 class="mt-4 fs-4">Editar role</h1>
  <ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">Roles</a></li>
    <li class="breadcrumb-item active">Editar role</li>
  </ol>
  <div>
    <div>
      <form action="{{ route('roles.update', $role) }}" method="POST">
        @method('PUT')
        @include('roles.form')
      </form>
    </div>
  </div>
@endsection