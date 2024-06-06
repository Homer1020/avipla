@extends('layouts.dashboard')
@section('title', 'Afiliados')
@section('content')
  <h1 class="mt-4">Afiliados</h1>
  <ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Afiliados</li>
  </ol>
  <div class="mb-4">
    <a href="{{ route('afiliados.create') }}" class="btn btn-primary">Crear afiliado</a>
  </div>

  <table class="table table-bordered">
    <thead>
      <tr>
        <th>ID</th>
        <th>Razón social</th>
        <th>RIF</th>
        <th>Correo</th>
        <th>Teléfono</th>
        <th>Acciones</th>
      </tr>
    </thead>

    <tbody>
      @foreach ($afiliados as $afiliado)
        <tr>
          <td>#{{$afiliado->id}}</td>
          <td>
            <span class="text-truncate d-inline-block" style="max-width: 150px">{{ $afiliado->razon_social }}</span>
          </td>
          <td>{{ $afiliado->rif }}</td>
          <td>{{ $afiliado->correo }}</td>
          <td>{{ $afiliado->telefono }}</td>
          <td>
            <a href="{{ route('afiliados.show', $afiliado) }}" class="btn btn-primary">
              <i class="fa fa-eye"></i>
              Detalles
            </a>

            <form action="{{ route('afiliados.destroy', $afiliado) }}" method="POST" class="d-inline-block" onsubmit="submitAfterConfirm(event.target); return false">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger">
                <i class="fa fa-trash"></i>
                Eliminar
              </button>
            </form>

            <a href="{{ route('afiliados.edit', $afiliado) }}" class="btn btn-warning">
              <i class="fa fa-pen"></i>
              Editar
            </a>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
@endsection

@push('script')
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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

  </script>
@endpush