@extends('layouts.dashboard')
@section('title', 'Noticias')
@push('css')
  <link rel="stylesheet" href="{{ asset('assets/css/datatables.min.css') }}">
@endpush
@section('content')
  <h1 class="mt-4">Noticias</h1>
  <ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Noticias</li>
  </ol>
  <div class="mb-4">
    <a href="{{ route('noticias.create') }}" class="btn btn-primary">Nueva noticia</a>
  </div>

  <div class="mb-4 card">
    <div class="card-body">
      <table class="table table-bordered w-100" id="afiliados-table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Título</th>
            <th>Fecha</th>
            <th>Categoría</th>
            <th>Estado</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($noticias as $noticia)
            <tr>
              <td>#{{ $noticia->id }}</td>
              <td>
                <a href="{{ route('news.item', $noticia) }}" target="_blank">
                  {{ $noticia->titulo }}
                </a>
              </td>
              <td>{{ $noticia->created_at }}</td>
              <td>
                @if ($noticia->categoria)
                  <span class="badge bg-primary">{{ $noticia->categoria->display_name }}</span>
                @else
                  <span class="badge bg-secondary">Sin categoría</span>
                @endif
              </td>
              <td>
                @if ($noticia->estatus === 'PUBLISHED')
                  <span class="bg-success badge">{{ $noticia->estatus }}</span>
                @else
                  <span class="bg-secondary badge">{{ $noticia->estatus }}</span>
                @endif 
              </td>
              <td style="white-space: nowrap">
                <a href="{{ route('noticias.edit', $noticia) }}" class="btn btn-warning">
                  <i class="fa fa-pen"></i>
                  Editar
                </a>
                <form class="d-inline-block" action="{{ route('noticias.destroy', $noticia) }}" onsubmit="submitAfterConfirm(event.target); return false" method="POST">
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
@endsection

@push('script')
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

    new DataTable('#afiliados-table', {
      columnDefs: [
        { orderable: false, targets: 5 },
      ],
      order: false,
      language: {
        // url: '//cdn.datatables.net/plug-ins/2.0.8/i18n/es-ES.json',
      }
    })
  </script>
@endpush