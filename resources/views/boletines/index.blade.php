@extends('layouts.dashboard')
@section('title', 'Boletines')
@section('content')
  <h1 class="mt-4">Boletines</h1>
  <ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Boletines</li>
  </ol>
  @can('create', App\Models\Boletine::class)
    <div class="mb-4">
      <a href="{{ route('boletines.create') }}" class="btn btn-primary">Crear Boletin</a>
    </div>

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
                  <a href="{{ route('boletines.show', $boletin) }}" target="_blank">{{ $boletin->titulo }}</a>
                </td>
                <td>
                  @if ($boletin->categoria)
                    <span class="badge bg-primary">{{ $boletin->categoria->display_name }}</span>
                  @else
                    <span class="badge bg-secondary">Sin categoría</span>
                  @endif
                </td>
                <td>
                  <a href="{{ route('boletines.edit', $boletin) }}" class="btn btn-warning">
                    <i class="fa fa-pen"></i>
                    Editar
                  </a>
                  <form class="d-inline-block" action="{{ route('boletines.destroy', $boletin) }}" onsubmit="submitAfterConfirm(event.target); return false" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" type="submit">
                      <i class="fa fa-trash"></i>
                      Eliminar
                    </button>
                  </form>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  @endcan
@endsection
@push('script')
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="{{ asset('assets/css/datatables.min.js') }}"></script>
  <script>
    new DataTable('#boletines-table', {
      columnDefs: [
        { orderable: false, targets: 4 },
      ],
      order: false,
      language: {
        // url: '//cdn.datatables.net/plug-ins/2.0.8/i18n/es-ES.json',
      }
    })
    
    function submitAfterConfirm(form) {
      Swal.fire({
        title: "¿Estas seguro?",
        text: "¡Esta acción no se puede revertir!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, eliminalo!",
        cancelButtonText: "Cancelar"
      }).then((result) => {
        if (result.isConfirmed) form.submit()
      })
    }
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