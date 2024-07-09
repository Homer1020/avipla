@extends('layouts.dashboard')
@section('title', 'Usuarios')
@section('content')
  <h1 class="mt-4">Usuarios</h1>
  <ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Usuarios</li>
  </ol>
  <div class="mb-4">
    <a href="{{ route('users.create') }}" class="btn btn-primary">Crear usuario</a>
  </div>

  <div class="card">
    <div class="card-body">
      <table class="table table-bordered w-100" id="users-table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Correo</th>
            <th>Role</th>
            <th>Acciones</th>
          </tr>
        </thead>
    
        <tbody>
          @foreach ($users as $user)
            <tr>
                <td>#{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    @foreach ($user->roles as $role)
                      @if($role->name === 'afiliado')
                        <span class="badge bg-secondary">
                          {{ $role->name }}
                        </span>
                      @else
                        <span class="badge bg-success">
                          {{ $role->name }}
                        </span>
                      @endif
                    @endforeach
                </td>
                <td style="white-space: nowrap">
                    <form action="{{ route('users.destroy', $user) }}" method="POST" class="d-inline-block" onsubmit="submitAfterConfirm(event.target); return false">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="fa fa-trash"></i>
                        Eliminar
                    </button>
                    </form>

                    <a href="{{ route('users.edit', $user) }}" class="btn btn-warning">
                    <i class="fa fa-pen"></i>
                    Editar
                    </a>
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

    new DataTable('#users-table', {
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