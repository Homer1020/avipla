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
      <p class="fw-bold text-uppercase">Datos de la empresa</p>
      @if ($afiliado->brand)
        <div class="mb-3">
          <img src="{{ Storage::url($afiliado->brand) }}" alt="{{ $afiliado->razon_social }}" height="150">
        </div>
      @endif
      <ul class="list-group mb-3">
        <li class="list-group-item">
          <span class="fw-bold">Razón social: </span>
          {{ $afiliado->razon_social }}
        </li>
        <li class="list-group-item">
          <span class="fw-bold">RIF: </span>
          {{ $afiliado->rif }}
        </li>
        <li class="list-group-item">
          <span class="fw-bold">Página web: </span>
          <a href="{{ $afiliado->pagina_web }}">{{ $afiliado->pagina_web }}</a>
        </li>
        <li class="list-group-item">
          <span class="fw-bold">Actividad principal: </span>
          {{ $afiliado->actividad->actividad }}
        </li>
        <li class="list-group-item">
          <span class="fw-bold">Relaciones de comercio exterior: </span>
          {{ $afiliado->relacion_comercio_exterior }}
        </li>
        <li class="list-group-item">
          <span class="fw-bold">Estado: </span>
          @if ($afiliado->estado)
            <span class="badge bg-success">Activo</span>
          @else
            <span class="badge bg-success">Inactivo</span>
          @endif
        </li>
        <li class="list-group-item">
            @if ($afiliado->rif_path)
              <a target="_blank" href="{{ route('files.getFile', ['dir' => 'afiliados', 'path' => $afiliado->rif_path]) }}" class="btn btn-primary">
                <i class="fa fa-file-invoice"></i>
                RIF
              </a>
            @endif
            @if ($afiliado->registro_mercantil_path)
              <a target="_blank" href="{{ route('files.getFile', ['dir' => 'afiliados', 'path' => $afiliado->registro_mercantil_path]) }}" class="btn btn-primary">
                <i class="fa fa-file-invoice"></i>
                Registro mercantil
              </a>
            @endif
            @if ($afiliado->estado_financiero_path)
              <a target="_blank" href="{{ route('files.getFile', ['dir' => 'afiliados', 'path' => $afiliado->estado_financiero_path]) }}" class="btn btn-primary">
                <i class="fa fa-file-invoice"></i>
                Estado financiero
              </a>
            @endif
          </li>
      </ul>
      <p class="fw-bold text-uppercase">Direcciones</p>
      <ul class="list-group mb-3">
        <li class="list-group-item">
          <span class="fw-bold">Dirección (oficina): </span>
          {{ $afiliado->direccion->direccion_oficina }}
        </li>
        <li class="list-group-item">
          <span class="fw-bold">Ciudad / estado (oficina): </span>
          {{ $afiliado->direccion->ciudad_oficina }}
        </li>
        <li class="list-group-item">
          <span class="fw-bold">Teléfono (oficina): </span>
          {{ $afiliado->direccion->telefono_oficina }}
        </li>
        <li class="list-group-item">
          <span class="fw-bold">Dirección (planta): </span>
          {{ $afiliado->direccion->direccion_planta }}
        </li>
        <li class="list-group-item">
          <span class="fw-bold">Ciudad / estado (planta): </span>
          {{ $afiliado->direccion->ciudad_planta }}
        </li>
        <li class="list-group-item">
          <span class="fw-bold">Teléfono (planta): </span>
          {{ $afiliado->direccion->telefono_planta }}
        </li>
      </ul>

      @if($afiliado->materias_primas->count())
        <p class="fw-bold text-uppercase">Principales materias primas utilizadas</p>
        <ul class="list-group mb-3">
          @foreach ($afiliado->materias_primas as $materia_prima)
            <li class="list-group-item">
              {{ $materia_prima->materia_prima }}
            </li>
          @endforeach
        </ul>
      @endif

      @if($afiliado->servicios->count())
        <p class="fw-bold text-uppercase">Servicios prestados</p>
        <ul class="list-group mb-3">
          @foreach ($afiliado->servicios as $servicio)
            <li class="list-group-item">
              {{ $servicio->nombre_servicio }}
            </li>
          @endforeach
        </ul>
      @endif

      @if($afiliado->referencias->count())
        <p class="fw-bold text-uppercase">Empresas asociadas a AVIPLA que la refieren</p>
        <ul class="list-group mb-3">
          @foreach ($afiliado->referencias as $referencia)
            <li class="list-group-item">
              {{ $referencia->razon_social }}
            </li>
          @endforeach
        </ul>
      @endif
    </div>
    <div class="col-lg-6">
      <p class="fw-bold text-uppercase">Datos del encargado</p>
      <ul class="list-group mb-3">
        @if($afiliado->user()->exists())
        @php
          $afiliado->load('user');    
        @endphp
          <li class="list-group-item"><span class="fw-bold">Encargado:</span> {{ $afiliado->user->name }}</li>
          <li class="list-group-item"><span class="fw-bold">Correo del encargado:</span> <a href="mailto:{{ $afiliado->user->email }}">{{ $afiliado->user->email }}</a></li>
        @else
          <li class="list-group-item">
            <span class="fw-bold">Solicitar registro por correo:</span>
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
      <p class="fw-bold text-uppercase">Datos del personal</p>
      <ul class="list-group mb-3">
        <li class="list-group-item">
          <span class="fw-bold">Correo del presidente: </span>
          {{ $afiliado->personal->correo_presidente }}
        </li>
        <li class="list-group-item">
          <span class="fw-bold">Correo del gerente general: </span>
          {{ $afiliado->personal->correo_gerente_general }}
        </li>
        <li class="list-group-item">
          <span class="fw-bold">Correo del gerente de compras: </span>
          {{ $afiliado->personal->correo_gerente_compras }}
        </li>
        <li class="list-group-item">
          <span class="fw-bold">Correo del gerente de mercadeo y/o ventas: </span>
          {{ $afiliado->personal->correo_gerente_marketing_ventas }}
        </li>
        <li class="list-group-item">
          <span class="fw-bold">Correo del gerente de planta: </span>
          {{ $afiliado->personal->correo_gerente_planta }}
        </li>
        <li class="list-group-item">
          <span class="fw-bold">Correo del gerente de recursos humanos: </span>
          {{ $afiliado->personal->correo_gerente_recursos_humanos }}
        </li>
        <li class="list-group-item">
          <span class="fw-bold">Correo del administrador: </span>
          {{ $afiliado->personal->correo_administrador }}
        </li>
        <li class="list-group-item">
          <span class="fw-bold">Correo del gerente de exportaciones: </span>
          {{ $afiliado->personal->correo_gerente_exportaciones }}
        </li>
        <li class="list-group-item">
          <span class="fw-bold">Correo del representante ante AVIPLA: </span>
          {{ $afiliado->personal->correo_representante_avipla }}
        </li>
        <li class="list-group-item">
          <span class="fw-bold">Teléfono del encargado del whatsapp: </span>
          {{ $afiliado->personal->numero_encargado_ws }}
        </li>
      </ul>

      @if ($afiliado->productos->count())
        <p class="fw-bold text-uppercase">Linea de productos</p>
        <ul class="list-group mb-3">
          @foreach ($afiliado->productos as $producto)
            <li class="list-group-item">
              <span class="fw-bold">Producto: </span>
              {{ $producto->nombre }}
              <br>
              <span class="fw-bold">Producción total mensual (TM): </span>
              {{ $producto->pivot->produccion_total_mensual }}
              <br>
              <span class="fw-bold">Porcentaje destinados a exportación: </span>
              {{ $producto->pivot->porcentage_exportacion }}
              <br>
              <span class="fw-bold">Mercados de importación / exportación: </span>
              {{ $producto->pivot->mercado_exportacion }}
            </li>
          @endforeach
        </ul>
      @endif
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