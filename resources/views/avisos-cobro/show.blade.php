@extends('layouts.dashboard')
@section('title', 'Detalle Factura')
@section('content')
  <h1 class="mt-4">Detalle Factura</h1>
  <ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('avisos-cobro.index') }}">Avisos de cobro</a></li>
    <li class="breadcrumb-item active">Detalle del aviso</li>
  </ol>
  
  <div class="row">
      <div class="col-lg-6">
        @if ($avisoCobro->pago)
            @php
                $pago = $avisoCobro->pago;
            @endphp
            <p class="fw-bold text-uppercase text-muted">Datos del pago</p>
            <ul class="list-group mb-4">
                <li class="list-group-item">
                    <span class="fw-bold">Método de pago:</span>
                    {{ $pago->metodo_pago->metodo_pago }}
                </li>
                <li class="list-group-item">
                    <span class="fw-bold">Monto:</span>
                    {{ $pago->monto }}$
                </li>
                <li class="list-group-item">
                    <span class="fw-bold">Referencia:</span>
                    {{ $pago->referencia }}
                </li>
                <li class="list-group-item">
                    <span class="fw-bold">Fecha:</span>
                    {{ $pago->created_at }}
                </li>
                <li class="list-group-item">
                    <a target="_blank" href="{{ route('files.getFile', ['dir' => 'comprobantes', 'path' => $pago->comprobante]) }}" class="btn btn-outline-primary">
                        <i class="fa fa-file"></i>
                        Comprobante
                    </a>
                </li>
            </ul>
        @endif
        <p class="fw-bold text-uppercase text-muted">Datos de factura</p>
        <ul class="list-group mb-4">
            <li class="list-group-item">
                <span class="fw-bold">Código:</span>
                #{{ $avisoCobro->numero_factura }}
            </li>
            <li class="list-group-item">
                <span class="fw-bold">Fecha de emisión:</span>
                {{ $avisoCobro->created_at }}
            </li>
            @if ($avisoCobro->fecha_limite)
                <li class="list-group-item">
                    <span class="fw-bold">Fecha de límite:</span>
                    {{ $avisoCobro->fecha_limite }}
                </li>
            @endif
            <li class="list-group-item">
                <span class="fw-bold">Monto total:</span>
                {{ $avisoCobro->monto_total }}$
            </li>
            <li class="list-group-item">
                <a target="_blank" href="{{ route('files.getFile', ['dir' => 'avisos-cobros', 'path' => $avisoCobro->documento]) }}" class="btn btn-outline-primary">
                    <i class="fa fa-file"></i>
                    Documento
                </a>
            </li>
            <li class="list-group-item">
                <form action="{{ route('avisos-cobro.update', $avisoCobro) }}" method="POST">
                    @method('PATCH')
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-bold">Estado:</label>
                        <select name="invoice_status" id="invoice_status" class="form-select">
                            <option selected disabled>Cambiar estado</option>
                            <option value="PENDIENTE" @selected($avisoCobro->estado === 'PENDIENTE')>PENDIENTE</option>
                            <option value="REVISION" @selected($avisoCobro->estado === 'REVISION')>COMPLETADO</option>
                            <option value="DEVUELTO" @selected($avisoCobro->estado === 'DEVUELTO')>DEVUELTO</option>
                            <option value="CONCILIADO" @selected($avisoCobro->estado === 'CONCILIADO')>CONCILIADO</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="observaciones" class="fw-bold form-label">Observaciones:</label>
                        <textarea
                            name="observaciones"
                            id="observaciones"
                            rows="2"
                            class="form-control @error('observaciones') is-invalid @enderror"
                        >{{ old('observaciones', $avisoCobro->observaciones) }}</textarea>
                        @error('is-invalid')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-outline-success"><i class="fa fa-check"></i> Guardar estado</button>
                </form>
            </li>
        </ul>
    </div>
    <div class="col-lg-6">
        <p class="fw-bold text-uppercase text-muted">Usuario emisor</p>
        <ul class="list-group mb-4">
            <li class="list-group-item">
                <span class="fw-bold">Nombre:</span>
                {{ $avisoCobro->user->name }}
            </li>
            <li class="list-group-item">
                <span class="fw-bold">Correo:</span>
                <a href="mailto:{{ $avisoCobro->user->email }}">{{ $avisoCobro->user->email }}</a>
            </li>
        </ul>

        <p class="fw-bold text-uppercase text-muted">Datos del afiliado</p>
        <ul class="list-group">
            <li class="list-group-item">
                <span class="fw-bold">Empresa:</span>
                {{ $avisoCobro->afiliado->razon_social }}
            </li>
            <li class="list-group-item">
                <span class="fw-bold">Correo:</span>
                <a href="mailto:{{ $avisoCobro->afiliado->user->email }}">{{ $avisoCobro->afiliado->user->email }}</a>
            </li>
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
@endpush