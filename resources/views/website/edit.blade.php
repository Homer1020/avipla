@extends('layouts.dashboard')
@section('title', 'Sitio web')
@section('content')
  <h1 class="mt-4">Sitio web</h1>
  <ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Sitio web</li>
  </ol>
@endsection