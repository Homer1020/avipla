@extends('layouts.dashboard')
@section('title', 'Roles')
@section('content')
<h1 class="mt-4">Base de datos</h1>
<ol class="breadcrumb mb-4">
  <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
  <li class="breadcrumb-item active">Base de datos</li>
</ol>
<section class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card">
        <div class="card-header text-center">
          <h4>Respaldo de Base de Datos</h4>
        </div>
        <div class="card-body">
          <p class="card-text text-center">Introduce la contraseña y haz clic en el botón para generar un respaldo de la base
            de datos.</p>

          <form action="" method="POST">
            @csrf
            <div class="form-group mb-3">
              <label class="mb-2" for="password">Contraseña <span class="text-danger">*</span></label>
              <input type="password" class="form-control" id="password" name="password"
                placeholder="Introduce la contraseña" required>
            </div>

            <div class="text-center">
              <button type="submit" class="btn btn-primary btn-block btn-lg">
                <i class="fas fa-database"></i> Respaldar Base de Datos
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>


@endsection