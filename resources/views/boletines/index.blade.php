@extends('layouts.dashboard')
@section('title', 'Boletines')
@push('css')
  <link rel="stylesheet" href="{{ asset('assets/css/datatables.min.css') }}">
@endpush
@section('content')
  <h1 class="mt-4 fs-4">
    <i class="fas fa-envelope fa-sm"></i>
    Boletines
  </h1>
  <ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Boletines</li>
  </ol>
  @can('create_boletine')
    <div class="mb-4">
      <a href="{{ route('boletines.create') }}" class="btn btn-primary">Crear Boletín</a>
    </div>
  @endcan

  <div class="card">
    <div class="card-body">
      <table class="table table-bordered w-100" id="boletines-table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Fecha</th>
            <th>Título</th>
            <th>Categoría</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($boletines as $boletin)
            <tr>
              <td>#{{ $boletin->id }}</td>
              <td>{{ $boletin->created_at->format('d-m-Y') }}</td>
              <td>
                <a href="{{ route('boletines.show', $boletin) }}">{{ $boletin->titulo }}</a>
              </td>
              <td>
                @if ($boletin->categoria)
                  <span class="badge bg-primary">{{ $boletin->categoria->display_name }}</span>
                @else
                  <span class="badge bg-secondary">Sin categoría</span>
                @endif
              </td>
              <td>
                @can('view', $boletin)
                  <a href="{{ route('boletines.show', $boletin) }}" class="btn btn-primary">
                    <i class="fa fa-envelope-open"></i>
                    Ver boletín
                  </a>
                @endcan
                @can('update', $boletin)
                  <a href="{{ route('boletines.edit', $boletin) }}" class="btn btn-warning">
                    <i class="fa fa-pen"></i>
                    Editar
                  </a>
                @endcan
                @can('delete', $boletin)
                  <form class="d-inline-block" action="{{ route('boletines.destroy', $boletin) }}" onsubmit="submitAfterConfirm(event.target); return false" method="POST">
                    @csrf
                    @method('DELETE', $boletin)
                    <button class="btn btn-danger" type="submit">
                      <i class="fa fa-trash"></i>
                      Eliminar
                    </button>
                  </form>
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
  <script src="{{ asset('assets/css/datatables.min.js') }}"></script>
  <script>
    new DataTable('#boletines-table', {
      columnDefs: [
        { orderable: false, targets: 4 },
      ],
      scrollX: true,
      language: datatableES()
    })
  </script>
  @if (session('success'))
    <script>
        Swal.fire({
            icon: "success",
            title: "{{ session('success') }}"
        });
    </script>
  @endif
@endpush