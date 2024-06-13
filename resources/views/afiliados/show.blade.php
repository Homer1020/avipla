@extends('layouts.dashboard')
@section('title', 'Detalle de ' . $afiliado->razon_social)
@section('content')
  <h1 class="mt-4">Detalle de {{ $afiliado->razon_social }}</h1>
  <ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('afiliados.index') }}">Afiliados</a></li>
    <li class="breadcrumb-item active">Detalle</li>
  </ol>

  <div class="row mb-4">
    <div class="col-lg-6">
      <p class="fw-bold text-uppercase text-muted">Datos de la empresa</p>
      <ul class="list-group mb-3">
        <li class="list-group-item">
          <span class="fw-bold d-block">Razón social: </span>
          {{ $afiliado->razon_social }}
        </li>
        <li class="list-group-item">
          <span class="fw-bold d-block">RIF: </span>
          {{ $afiliado->rif }}
        </li>
        <li class="list-group-item">
          <span class="fw-bold d-block">Página web: </span>
          <a href="{{ $afiliado->pagina_web }}">{{ $afiliado->pagina_web }}</a>
        </li>
        <li class="list-group-item">
          <span class="fw-bold d-block">Correo: </span>
          <a href="mailto:{{ $afiliado->correo }}">{{ $afiliado->correo }}</a>
        </li>
        <li class="list-group-item">
          <span class="fw-bold d-block">Estado: </span>
          @if ($afiliado->estado)
            <span class="badge bg-success">Activo</span>
          @else
            <span class="badge bg-success">Inactivo</span>
          @endif
        </li>
      </ul>
      <p class="fw-bold text-uppercase text-muted">Direcciones</p>
      <ul class="list-group mb-3">
        <li class="list-group-item">
          <span class="fw-bold d-block">Dirección (oficina): </span>
          {{ $afiliado->direccion->direccion_oficina }}
        </li>
        <li class="list-group-item">
          <span class="fw-bold d-block">Ciudad / estado (oficina): </span>
          {{ $afiliado->direccion->ciudad_oficina }}
        </li>
        <li class="list-group-item">
          <span class="fw-bold d-block">Teléfono (oficina): </span>
          {{ $afiliado->direccion->telefono_oficina }}
        </li>
        <li class="list-group-item">
          <span class="fw-bold d-block">Dirección (planta): </span>
          {{ $afiliado->direccion->direccion_planta }}
        </li>
        <li class="list-group-item">
          <span class="fw-bold d-block">Ciudad / estado (planta): </span>
          {{ $afiliado->direccion->ciudad_planta }}
        </li>
        <li class="list-group-item">
          <span class="fw-bold d-block">Teléfono (planta): </span>
          {{ $afiliado->direccion->telefono_planta }}
        </li>
      </ul>
    </div>
    <div class="col-lg-6">
      <p class="fw-bold text-uppercase text-muted">Datos del encargado</p>
      <ul class="list-group">
        @if($afiliado->user()->exists())
        @php
          $afiliado->load('user');    
        @endphp
          <li class="list-group-item"><span class="fw-bold d-block">Encargado:</span> {{ $afiliado->user->name }}</li>
          <li class="list-group-item"><span class="fw-bold d-block">Correo del encargado:</span> <a href="mailto:{{ $afiliado->user->email }}">{{ $afiliado->user->email }}</a></li>
        @else
          <li class="list-group-item">
            <span class="fw-bold d-block">Solicitar registro por correo:</span>
            <form action="{{ route('afiliados.sendConfirmationEmail', $afiliado) }}" method="POST">
              @csrf
              <button type="submit" class="btn btn-success mt-2">
                <i class="fa fa-envelope"></i>
                Enviar correo
              </button>
            </form>
            @if ($afiliado->confirmation_code)
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
              <div class="alert alert-primary d-flex align-items-center mt-2 mb-0" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Info:"><use xlink:href="#info-fill"/></svg>
                <div>
                  Ya se envió un enlace pare el registro.
                </div>
              </div>
            @endif
          </li>
        @endif
      </ul>
    </div>
  </div>
@endsection
@push('script')
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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

  </script>
@endpush