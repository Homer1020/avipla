@extends('layouts.dashboard')
@section('title', 'Afiliados')
@push('css')
  <link rel="stylesheet" href="{{ asset('assets/css/datatables.min.css') }}">
@endpush
@section('content')
  <h1 class="mt-4">Afiliados</h1>
  <ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Afiliados</li>
  </ol>
  <div class="mb-4">
    <a href="{{ route('afiliados.requestForm') }}" class="btn btn-primary">Solicitar afiliado</a>
    {{-- <a href="{{ route('afiliados.create') }}" disabled class="btn btn-success disabled">Nuevo afiliado</a> --}}
  </div>

  <div class="mb-4 card">
    <div class="card-body">
      <table class="table table-bordered w-100" id="afiliados-table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Solicitado</th>
            <th>Razón social</th>
            <th>Correo</th>
            <th>Acciones</th>
          </tr>
        </thead>
    
        <tbody>
          @foreach ($solicitudes as $solicitud)
            <tr>
              <td>#{{$solicitud->id}}</td>
              <td>{{$solicitud->created_at->diffForHumans()}}</td>
              <td>
                <span class="text-truncate d-inline-block" style="max-width: 150px">
                  {{ $solicitud->afiliado ? $solicitud->afiliado->razon_social : $solicitud->razon_social }}
                </span>
              </td>
              <td>{{ $solicitud->correo }}</td>
              <td style="white-space: nowrap">
                @if ($solicitud->afiliado)
                  @can('view', $solicitud->afiliado)
                    <a href="{{ route('afiliados.show', $solicitud->afiliado) }}" class="btn btn-primary">
                      <i class="fa fa-eye"></i>
                      Detalles
                    </a>
                  @endcan
                  @can('delete', $solicitud->afiliado)
                    <form action="{{ route('afiliados.destroy', $solicitud->afiliado) }}" method="POST" class="d-inline-block" onsubmit="submitAfterConfirm(event.target); return false">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-danger">
                        <i class="fa fa-trash"></i>
                        Eliminar
                      </button>
                    </form>
                  @endcan
                  @can('update', $solicitud->afiliado)
                    <a href="{{ route('afiliados.edit', $solicitud->afiliado) }}" class="btn btn-warning">
                      <i class="fa fa-pen"></i>
                      Editar
                    </a>
                  @endcan
                @else
                  <form action="{{ route('afiliados.reminder', $solicitud) }}" method="POST">
                    @csrf
                    <a href="#" onclick="event.target.parentElement.submit(); return false;" class="btn btn-outline-primary">
                      <i class="fa fa-envelope me-1"></i>
                      Enviar recordatorio
                    </a>
                  </form>
                @endif
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

    function resend() {
      console.log(event.target);
    }

    new DataTable('#afiliados-table', {
      columnDefs: [
        { orderable: false, targets: 4 },
      ],
      order: false,
      scrollX: false,
      language: {
        // url: '//cdn.datatables.net/plug-ins/2.0.8/i18n/es-ES.json',
      }
    })
  </script>
@endpush