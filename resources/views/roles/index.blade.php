@extends('layouts.dashboard')
@section('title', 'Roles')
@section('content')
  <h1 class="mt-4 fs-4">
    <i class="fas fa-briefcase fa-sm"></i>
    Roles
  </h1>
  <ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Roles</li>
  </ol>
  <div class="mb-4">
    <a href="{{ route('roles.create') }}" class="btn btn-primary">Crear rol</a>
  </div>
  <div class="row">
    @forelse ($roles as $role)
      <div class="col-md-3">
        <div class="card">
          <div class="card-body">
            <h2 class="h5">{{ $role->name }}</h2>
            <p>Permisos: {{ $role->permissions->count() }}</p>
            <div>

              <a href="{{ route('roles.edit', $role) }}" class="btn btn-warning btn-sm">
                <i class="fa fa-pen"></i>
                Editar
              </a>

              <form action="{{ route('roles.destroy', $role) }}" method="POST" class="d-inline-block">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm">
                  <i class="fa fa-trash"></i>
                  Eliminar
                </button>
              </form>
            </div>
          </div>
        </div>
      </div>
    @empty
      <div class="col-12">
        <div class="alert alert-info">Aún no hay roles en el sistema.</div>
      </div>
    @endforelse
  </div>
@endsection

@push('script')
  @if (session('success'))
    <script>
      Swal.fire({
        icon: "success",
        title: "{{ session('success') }}"
      });
    </script>
  @endif
@endpush