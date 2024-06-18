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
            <th>Razón social</th>
            <th>Correo</th>
            <th>Acciones</th>
          </tr>
        </thead>
    
        <tbody>
          @foreach ($solicitudes as $solicitud)
            <tr>
              <td>#{{$solicitud->id}}</td>
              <td>
                <span class="text-truncate d-inline-block" style="max-width: 150px">{{ $solicitud->razon_social }}</span>
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
                  <div class="alert alert-info m-0">
                    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                      <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                      </symbol>
                      <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                      </symbol>
                      <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                      </symbol>
                    </svg>
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Info:"><use xlink:href="#info-fill"/></svg>
                    La cuenta no ha sido registrada aun.
                  </div>
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

    new DataTable('#afiliados-table', {
      columnDefs: [
        { orderable: false, targets: 3 },
      ],
      order: false,
      language: {
        // url: '//cdn.datatables.net/plug-ins/2.0.8/i18n/es-ES.json',
      }
    })
  </script>
@endpush