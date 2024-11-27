@extends('layouts.dashboard')
@section('title', 'Categorías')
@push('css')
  <link rel="stylesheet" href="{{ asset('assets/css/datatables.min.css') }}">
@endpush
@section('content')
  <h1 class="mt-4 fs-4">Categorías</h1>
  <ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('noticias.index') }}">Noticias</a></li>
    <li class="breadcrumb-item active">Categorías</li>
  </ol>
  <div class="mb-4">
    <a href="{{ route('categories.create') }}" class="btn btn-primary">Crear categoría</a>
  </div>

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
                  $categorias_length = $categoria->noticias->count();
                @endphp
                <tr>
                    <td>#{{ $categoria->id }}</td>
                    <td>
                      <a href="{{ route('category.show', $categoria) }}">{{ $categoria->display_name }} ({{ $categorias_length }} {{ ($categorias_length > 1 || $categorias_length === 0)? 'noticias' : 'noticia' }})</a>
                    </td>
                    <td>{{ $categoria->name }}</td>
                    <td style="white-space: nowrap">
                      @can('delete_category')
                        <form action="{{ route('categories.destroy', $categoria) }}" method="POST" class="d-inline-block" onsubmit="submitAfterConfirm(event.target); return false">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-danger">
                              <i class="fa fa-trash"></i>
                              Eliminar
                          </button>
                        </form>
                      @endcan

                      @can('update_category')
                        <a href="{{ route('categories.edit', $categoria) }}" class="btn btn-warning">
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
        { orderable: false, targets: 2 },
      ],
      order: false,
      scrollX: false,
      language: datatableES()
    })
  </script>
@endpush