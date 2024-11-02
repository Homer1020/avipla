@extends('layouts.dashboard')
@section('title', 'Perfil de usuario')
@section('content')
  <h1 class="mt-4 fs-4">Perfil del presidente</h1>
  <ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Perfil del presidente</li>
  </ol>
  <div class="card mb-4">
    <div class="card-header">
      <p class="m-0">Perfil del presidente</p>
    </div>
    <div class="card-body">
      <form action="{{ route('profile.storePresidente') }}" method="POST">
        @csrf
        <div class="mb-3">
          <label for="name" class="form-label">Nombre</label>
          <input
            type="text"
            name="name"
            id="name"
            class="form-control @error('name') is-invalid @enderror"
            value="{{ old('name', $presidente->name) }}"
            placeholder="John Doe"
          >
          @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>
      
        <div class="mb-3">
          <label for="email" class="form-label">Correo</label>
          <input
            type="text"
            name="email"
            id="email"
            class="form-control @error('email') is-invalid @enderror"
            value="{{ old('email', $presidente->email) }}"
            placeholder="john@doe.com"
          >
          @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>
  
        <div class="mb-3">
          <label for="password" class="form-label">Contraseña</label>
          <input
            type="password"
            name="password"
            id="password"
            class="form-control @error('password') is-invalid @enderror"
            placeholder="*******"
          >
          @error('password')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>
  
        <div class="mb-3">
          <label for="password_confirmation" class="form-label">Confirmar contraseña</label>
          <input
            type="password"
            name="password_confirmation"
            id="password_confirmation"
            class="form-control @error('password_confirmation') is-invalid @enderror"
            placeholder="*******"
          >
        </div>

        <button class="btn btn-primary">
            <i class="fa fa-save"></i>
            Guardar perfil
        </button>
      </form>
    </div>
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