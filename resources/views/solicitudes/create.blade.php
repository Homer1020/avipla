@extends('layouts.dashboard')
@section('title', 'Solicitar Afiliado')
@section('content')
<h1 class="mt-4">Solicitar Afiliado</h1>
<ol class="breadcrumb mb-4">
  <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
  <li class="breadcrumb-item"><a href="{{ route('solicitudes.index') }}">Solicitudes</a></li>
  <li class="breadcrumb-item active">Solicitar Afiliado</li>
</ol>

<form action="{{ route('solicitudes.store') }}" method="POST">
  @csrf
  <div class="card mb-4">
    <div class="card-body">
        <x-forms.input
            name="razon_social"
            id="razon_social"
            required
            autofocus
            placeholder="Empresas polar"
            label="Razón social"
            :value="old('razon_social')"
            :error="$errors->first('razon_social')"
        />
        <x-forms.input
            type="email"
            name="correo"
            id="correo"
            required
            autofocus
            placeholder="empresas@polar.com"
            label="Correo de la empresa"
            :value="old('correo')"
            :error="$errors->first('correo')"
        />
        <button type="submit" class="btn btn-success">Enviar correo</button>
    </div>
  </div>
</form>
@endsection