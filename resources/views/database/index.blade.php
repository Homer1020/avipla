@extends('layouts.dashboard')
@section('title', 'Base de datos')
@section('content')
<h1 class="mt-4 fs-4">Base de datos</h1>
<ol class="breadcrumb mb-4">
  <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
  <li class="breadcrumb-item active">Base de datos</li>
</ol>
<div class="row mt-3">
  <div class="col-md-6 mb-3 mb-md-0">
    <div class="card shadow-sm">
      <div class="card-header">
        <p class="mb-0">Respaldos</p>
      </div>
      <div class="card-body">
        <table class="table table-bordered">
          <thead>
            <th>Fecha</th>
            <th>Encargado</th>
            <th>Nota</th>
            <th>Descargar</th>
          </thead>
        </table>
      </div>
    </div>
  </div>

  <div class="col-md-6">
    <div class="card shadow-sm">
      <div class="card-header">
        <p class="mb-0">Respaldo de la Base de Datos</p>
      </div>
      <div class="card-body">
        <form action="{{ route('database.backup') }}" method="POST">
          @csrf
          <div class="mb-3">
            <label for="file_name" class="form-label">Nombre del archivo</label>
            <input type="text" id="file_name" name="file_name" class="form-control">
          </div>
          {{-- <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" value="" id="download_file" checked>
            <label class="form-check-label" for="download_file">
              Descargar archivo
            </label>
          </div> --}}
          <button type="submit" class="btn btn-primary">
            <i class="fas fa-database"></i> Respaldar Base de Datos
          </button>
        </form>
      </div>
    </div>
  </div>  
</div>

@push('script')
  @if (session('success'))
    <script>
      Swal.fire({
        icon: "success",
        title: "{{ session('success') }}"
      });
    </script>
  @endif
@endpush
@endsection