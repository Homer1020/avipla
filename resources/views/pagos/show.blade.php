@extends('layouts.dashboard')
@section('title', 'Detalle Factura')
@section('content')
  <h1 class="mt-4">Detalles del aviso</h1>
  <ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('pagos.index') }}">Estado de cuenta</a></li>
    <li class="breadcrumb-item active">Aviso de cobro #{{ $avisoCobro->codigo_aviso }}</li>
  </ol>
  <div class="row">
      @if ($avisoCobro->pago)
      <div class="col-lg-6">
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
                    <span class="fw-bold">Banco:</span>
                    {{ $pago->banco ? $pago->banco->nombre : 'N/A' }}
                </li>
                <li class="list-group-item">
                    <span class="fw-bold">Referencia:</span>
                    {{ $pago->referencia ? '#' . $pago->referencia : 'N/A' }}
                </li>
                <li class="list-group-item">
                    <span class="fw-bold">Tasa:</span>
                    {{ $pago->tasa ? 'Bs.s ' . $pago->tasa : 'N/A' }}
                </li>
                <li class="list-group-item">
                    <span class="fw-bold">Empresa:</span>
                    {{ $avisoCobro->afiliado->razon_social }}
                </li>
                <li class="list-group-item">
                    <span class="fw-bold">Correo:</span>
                    <a href="mailto:{{ $avisoCobro->afiliado->user->email }}">{{ $avisoCobro->afiliado->user->email }}</a>
                </li>
                <li class="list-group-item">
                    <span class="fw-bold">Fecha de pago:</span>
                    {{ $pago->fecha_pago }}
                </li>
                @if ($pago->comprobante)
                    <li class="list-group-item">
                        <span class="fw-bold d-block mb-2">Comprobante de pago:</span>
                        <a target="_blank" href="{{ route('files.getFile', ['dir' => 'comprobantes', 'path' => $pago->comprobante]) }}" class="btn btn-outline-primary">
                            <i class="fa fa-file"></i>
                            Comprobante
                        </a>
                    </li>
                @endif
                @if ($avisoCobro->estado === 'DEVUELTO')
                    <li class="list-group-item">
                        <span class="fw-bold d-block mb-2">Modificar pago:</span>
                        <a href="{{ route('pagos.edit', $pago) }}" type="submit" class="btn btn-warning">
                            <i class="fas fa-file-invoice"></i>
                            Modificar Pago
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    @endif
    <div class="col-lg-6">
        <p class="fw-bold text-uppercase text-muted">Datos del aviso</p>
        <ul class="list-group mb-4">
            <li class="list-group-item">
                <span class="fw-bold">Código:</span>
                #{{ $avisoCobro->codigo_aviso }}
            </li>
            <li class="list-group-item">
                <span class="fw-bold">Fecha de emisión:</span>
                {{ $avisoCobro->created_at }}
            </li>
            <li class="list-group-item">
                <span class="fw-bold">Emisor:</span>
                {{ $avisoCobro->user->name }}
            </li>
            <li class="list-group-item">
                <span class="fw-bold">Correo del emisor:</span>
                <a href="mailto:{{ $avisoCobro->user->email }}">{{ $avisoCobro->user->email }}</a>
            </li>
            <li class="list-group-item">
                <span class="fw-bold">Monto total:</span>
                {{ $avisoCobro->monto_total }}$
            </li>
            <li class="list-group-item">
                <span class="fw-bold">Estado:</span>
                @include('partials.invoice_status')
            </li>
            <li class="list-group-item">
                <span class="fw-bold">Observaciones:</span>
                {{ $avisoCobro->observaciones }}
            </li>
            
            @if (!$avisoCobro->pago)
                <li class="list-group-item">
                    <span class="fw-bold d-block mb-2">Adjuntar pago:</span>
                    <a href="{{ route('avisos-cobro.payCollectionNotice', $avisoCobro) }}" type="submit" class="btn btn-primary">
                        <i class="fas fa-file-invoice"></i>
                        Adjuntar pago
                    </a>
                </li>
            @endif
        </ul>
    </div>
  </div>
@endsection