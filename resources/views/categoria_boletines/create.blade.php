@extends('layouts.dashboard')
@section('title', 'Crear Categoría')
@push('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
@endpush
@section('content')
  <h1 class="mt-4 fs-4">
    <i class="fas fa-envelope fa-sm"></i>
    Crear Categoría
  </h1>
  <ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('boletines.index') }}">Boletines</a></li>
    <li class="breadcrumb-item"><a href="{{ route('categories.index') }}">Categorías</a></li>
    <li class="breadcrumb-item active">Crear Categoría</li>
  </ol>

  <form action="{{ route('categorias-boletines.store') }}" method="POST">
    @csrf
    <div class="card mb-4">
      <div class="card-body">
        <label for="display_name" class="form-label">Categoría</label>
        <input
            type="text"
            name="display_name"
            id="display_name"
            class="form-control @error('display_name') is-invalid @enderror"
        >
        @error('display_name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
        <button type="submit" class="btn btn-primary mt-4">Crear Categoría</button>
      </div>
    </div>
  </form>
@endsection
@push('script')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#afiliado_id').select2({
                theme: 'bootstrap-5'
            })
        })
    </script>
@endpush