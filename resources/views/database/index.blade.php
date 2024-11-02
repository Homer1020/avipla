@extends('layouts.dashboard')
@section('title', 'Roles')
@section('content')
<h1 class="mt-4 fs-4">Base de datos</h1>
<ol class="breadcrumb mb-4">
  <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
  <li class="breadcrumb-item active">Base de datos</li>
</ol>
<section class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card shadow-sm">
        <div class="card-header">
          <p class="mb-0">Respaldo de Base de Datos</p>
        </div>
        <div class="card-body">
          <div class="alert alert-info text-center">
            <p class="card-text">Introduce la contraseña y haz clic en el botón para generar un respaldo de la base de datos.</p>
          </div>
          <form action="" method="POST">
            @csrf
            <div class="mb-3">
              <label class="mb-2" for="password">Contraseña <span class="text-danger">*</span></label>
              <input
                type="password"
                class="form-control"
                id="password"
                name="password"
                placeholder="Introduce la contraseña"
                required
              >
            </div>
            <button type="submit" class="btn btn-primary">
              <i class="fas fa-database"></i> Respaldar Base de Datos
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>


@endsection