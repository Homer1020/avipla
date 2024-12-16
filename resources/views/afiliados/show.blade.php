@extends('layouts.dashboard')
@section('title', 'Detalle de ' . $afiliado->razon_social)
@section('content')
  <h1 class="mt-4 fs-4">Detalle de {{ $afiliado->razon_social }}</h1>
  <ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('afiliados.index') }}">Afiliados</a></li>
    <li class="breadcrumb-item active">Detalle</li>
  </ol>

  <div class="row mb-4">
    <div class="col-lg-4">
      <div class="card h-100">
        <div class="card-body py-4">
          @if ($afiliado->brand)
            <div class="mb-3 text-center">
              <img src="{{ Storage::url($afiliado->brand) }}" alt="{{ $afiliado->razon_social }}" height="100">
            </div>
          @endif
          <ul class="list-group list-group-flush mb-3">
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
            @if ($afiliado->user)
              <li class="list-group-item">
                <span class="fw-bold">Nombre del encargado: </span>
                {{ $afiliado->user->name }}
              </li>
              <li class="list-group-item">
                <span class="fw-bold">Correo del encargado: </span>
                {{ $afiliado->user->email }}
              </li>
            @endif
            @if($afiliado->actividad)
              <li class="list-group-item">
                <span class="fw-bold">Actividad principal: </span>
                {{ $afiliado->actividad->actividad }}
              </li>
            @endif
            <li class="list-group-item">
              <span class="fw-bold">Relaciones de comercio exterior: </span>
              {{ $afiliado->relacion_comercio_exterior }}
            </li>
            <li class="list-group-item">
              <span class="fw-bold">Estado: </span>
              @if ($afiliado->account_status)
                <span class="badge bg-success">Activo</span>
              @else
                <span class="badge bg-danger">Inactivo</span>
              @endif
            </li>
          </ul> 
        </div>
      </div>
    </div>
    <div class="col-lg-8">
      <div class="card h-100">
        <div class="card-body">
          <!-- Nav tabs -->
          <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Direcciones</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Actividades</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="messages-tab" data-bs-toggle="tab" data-bs-target="#messages" type="button" role="tab" aria-controls="messages" aria-selected="false">Personal</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="settings-tab" data-bs-toggle="tab" data-bs-target="#settings" type="button" role="tab" aria-controls="settings" aria-selected="false">Productos</button>
            </li>
          </ul>

          <!-- Tab panes -->
          <div class="tab-content">
            <div class="tab-pane active" id="home" role="tabpanel" aria-labelledby="home-tab">
              <p class="fw-bold text-uppercase my-3">Direcciones</p>
              <div class="row">
                <div class="col-md-6">
                  <ul class="list-group mb-0">
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
                  </ul>
                </div>
                <div class="col-md-6">
                  <ul class="list-group">
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
                </div>
              </div>
              @if ($afiliado->rif_path || $afiliado->registro_mercantil_path || $afiliado->estado_financiero_path)
                <p class="fw-bold text-uppercase my-3">Documentos</p>
                <div>
                  @if ($afiliado->rif_path)
                    <a target="_blank" href="{{ route('files.getFile', ['dir' => 'afiliados', 'path' => $afiliado->rif_path]) }}" class="btn btn-outline-primary me-2">
                      <i class="fa fa-file-invoice me-1"></i>
                      RIF
                    </a>
                  @endif
                  @if ($afiliado->registro_mercantil_path)
                    <a target="_blank" href="{{ route('files.getFile', ['dir' => 'afiliados', 'path' => $afiliado->registro_mercantil_path]) }}" class="btn btn-outline-primary me-2">
                      <i class="fa fa-file-invoice me-1"></i>
                      Registro mercantil
                    </a>
                  @endif
                  @if ($afiliado->estado_financiero_path)
                    <a target="_blank" href="{{ route('files.getFile', ['dir' => 'afiliados', 'path' => $afiliado->estado_financiero_path]) }}" class="btn btn-outline-primary me-2">
                      <i class="fa fa-file-invoice me-1"></i>
                      Estado financiero
                    </a>
                  @endif
                </div>
              @endif
            </div>
            <div class="tab-pane" id="profile" role="tabpanel" aria-labelledby="profile-tab">
              <p class="fw-bold text-uppercase my-3">Actividades</p>
              <div class="card">
                <div class="card-body">
                  @if($afiliado->materias_primas->count())
                    <p class="card-title fw-bold">Principales materias primas utilizadas</p>
                    <p class="card-text">
                      {{ implode(', ', $afiliado->materias_primas->pluck('materia_prima')->toArray()) }}
                    </p>
                  @endif
        
                  @if($afiliado->servicios->count())
                    <hr>
                    <p class="card-title fw-bold">Servicios prestados</p>
                    <p class="card-text">
                      {{ implode(', ', $afiliado->servicios->pluck('nombre_servicio')->toArray()) }}
                    </p>
                  @endif
        
                  @if($afiliado->referencias->count())
                    <hr>
                    <p class="card-title fw-bold">Empresas asociadas a AVIPLA que la refieren</p>
                    <p class="card-text">
                      {{ implode(', ', $afiliado->referencias->pluck('razon_social')->toArray()) }}
                    </p>
                  @endif
                </div>
              </div>    
            </div>
            <div class="tab-pane" id="messages" role="tabpanel" aria-labelledby="messages-tab">
              <p class="fw-bold text-uppercase my-3">Datos del personal</p>
              <ul class="list-group mb-3">
                @if ($afiliado->personal->correo_presidente)
                  <li class="list-group-item">
                    <span class="fw-bold">Correo del presidente: </span>
                    {{ $afiliado->personal->correo_presidente }}
                  </li>  
                @endif
                @if ($afiliado->personal->correo_gerente_general)
                  <li class="list-group-item">
                    <span class="fw-bold">Correo del gerente general: </span>
                    {{ $afiliado->personal->correo_gerente_general }}
                  </li>
                @endif
                @if($afiliado->personal->correo_gerente_compras)
                <li class="list-group-item">
                  <span class="fw-bold">Correo del gerente de compras: </span>
                  {{ $afiliado->personal->correo_gerente_compras }}
                </li>
                @endif
                @if($afiliado->personal->correo_gerente_marketing_ventas)
                <li class="list-group-item">
                  <span class="fw-bold">Correo del gerente de mercadeo y/o ventas: </span>
                  {{ $afiliado->personal->correo_gerente_marketing_ventas }}
                </li>
                @endif
                @if($afiliado->personal->correo_gerente_planta)
                <li class="list-group-item">
                  <span class="fw-bold">Correo del gerente de planta: </span>
                  {{ $afiliado->personal->correo_gerente_planta }}
                </li>
                @endif
                @if($afiliado->personal->correo_gerente_recursos_humanos)
                <li class="list-group-item">
                  <span class="fw-bold">Correo del gerente de recursos humanos: </span>
                  {{ $afiliado->personal->correo_gerente_recursos_humanos }}
                </li>
                @endif
                @if($afiliado->personal->correo_administrador)
                <li class="list-group-item">
                  <span class="fw-bold">Correo del administrador: </span>
                  {{ $afiliado->personal->correo_administrador }}
                </li>
                @endif
                @if($afiliado->personal->correo_gerente_exportaciones)
                <li class="list-group-item">
                  <span class="fw-bold">Correo del gerente de exportaciones: </span>
                  {{ $afiliado->personal->correo_gerente_exportaciones }}
                </li>
                @endif
                @if($afiliado->personal->correo_representante_avipla)
                <li class="list-group-item">
                  <span class="fw-bold">Correo del representante ante AVIPLA: </span>
                  {{ $afiliado->personal->correo_representante_avipla }}
                </li>
                @endif
                @if($afiliado->personal->numero_encargado_ws)
                <li class="list-group-item">
                  <span class="fw-bold">Teléfono del encargado del whatsapp: </span>
                  {{ $afiliado->personal->numero_encargado_ws }}
                </li>
                @endif
              </ul>

            </div>
            <div class="tab-pane" id="settings" role="tabpanel" aria-labelledby="settings-tab">
              @if ($afiliado->productos->count())
                <p class="fw-bold text-uppercase my-3">Línea de productos</p>
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
        </div>
      </div>
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