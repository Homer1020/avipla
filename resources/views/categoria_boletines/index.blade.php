@extends('layouts.dashboard')
@section('title', 'Categorías')
@push('css')
  <link rel="stylesheet" href="{{ asset('assets/css/datatables.min.css') }}">
@endpush
@section('content')
  <h1 class="mt-4 fs-4">
    <i class="fas fa-envelope fa-sm"></i>
    Categorías
  </h1>
  <ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('boletines.index') }}">Boletines</a></li>
    <li class="breadcrumb-item active">Categorías</li>
  </ol>
  @can('create_category_boletine')
    <div class="mb-4">
      <a href="{{ route('categorias-boletines.create') }}" class="btn btn-primary">Crear categoría</a>
    </div>
  @endcan

  <div class="mb-4 card">
    <div class="card-body">
      <table class="table table-bordered w-100" id="categories-table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Categoría</th>
            <th>Slug</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($categorias as $categoria)
                @php
                  $categorias_length = $categoria->boletines->count();
                @endphp
                <tr>
                    <td>#{{ $categoria->id }}</td>
                    <td>
                      {{ $categoria->display_name }} ({{ $categorias_length }} {{ ($categorias_length > 1 || $categorias_length === 0)? 'boletines' : 'boletin' }})
                    </td>
                    <td>{{ $categoria->name }}</td>
                    <td style="white-space: nowrap">
                      @can('delete', $categoria)
                        <form action="{{ route('categorias-boletines.destroy', $categoria) }}" method="POST" class="d-inline-block" onsubmit="submitAfterConfirm(event.target); return false">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-danger">
                              <i class="fa fa-trash"></i>
                              Eliminar
                          </button>
                        </form>
                      @endcan

                      @can('update', $categoria)
                        <a href="{{ route('categorias-boletines.edit', $categoria) }}" class="btn btn-warning">
                          <i class="fa fa-pen"></i>
                          Editar
                        </a>
                      @endcan
                  </td>
                </tr>
            @endforeach
        </tbody>
      </table>
    </div>
  </div>
@endsection

@push('script')
  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <script src="{{ asset('assets/css/datatables.min.js') }}"></script>

  @if (session('success'))
    <script>
        Swal.fire({
            icon: "success",
            title: "{{ session('success') }}"
        });
    </script>
  @endif

  <script>
    new DataTable('#categories-table', {
      columnDefs: [
        { orderable: false, targets: 3 },
      ],
      order: false,
      scrollX: false,
      language: datatableES()
    })
  </script>
@endpush