@extends('layouts.dashboard')
@section('title', 'Detalle de factura')
@section('content')
  <h1 class="mt-4">Detalle de factura</h1>
  <ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('invoices.index') }}">Facturas</a></li>
    <li class="breadcrumb-item active">Detalle de factura #{{ $factura->numero_factura }}</li>
  </ol>

  <div class="card mb-4">
    <div class="card-body">
        <h3 class="text-uppercase fs-6 fw-bold mb-4">Datos de la factura</h3>
        <p>
            <span class="fw-bold">Código:</span>
            <span>#{{ $factura->codigo_factura }}</span>
        </p>
        <p>
            <span class="fw-bold">Factura N:</span>
            <span>#{{ $factura->numero_factura }}</span>
        </p>
        <p>
            <span class="fw-bold">Emitida el:</span>
            <span>{{ $factura->created_at->format('Y-m-d') }}</span>
        </p>
        <p>
            <span class="fw-bold">Empresa receptora</span>
            <span>{{ $factura->avisoCobro->afiliado->razon_social }}</span>
        </p>
        <hr>
        <h3 class="text-uppercase fs-6 fw-bold my-4">Datos del pago</h3>
        <p>
            <span class="fw-bold">Método de pago</span>
            <span>{{ $factura->avisoCobro->pago->metodo_pago->metodo_pago }}</span>
        </p>
        <p>
            <span class="fw-bold">Referencia</span>
            <span>{{ $factura->avisoCobro->pago->referencia }}</span>
        </p>
        <p>
            <span class="fw-bold">Banco</span>
            <span>{{ $factura->avisoCobro->pago->banco->codigo }} - {{ $factura->avisoCobro->pago->banco->nombre }}</span>
        </p>
        <p>
            <span class="fw-bold">Tasa de cambio</span>
            <span>Bs.s {{ $factura->avisoCobro->pago->tasa }}</span>
        </p>
        <p>
            <span class="fw-bold">Fecha del pago</span>
            <span>{{ $factura->avisoCobro->pago->fecha_pago }}</span>
        </p>
        <p>
            <span class="fw-bold">Monto</span>
            <span>{{ $factura->avisoCobro->pago->monto }}$</span>
        </p>
        <hr>
        <h3 class="text-uppercase fs-6 fw-bold my-4">Aviso de cobro</h3>
        <p>
            <span class="fw-bold">Código del aviso:</span>
            <span>#{{ $factura->avisoCobro->codigo_aviso }}</span>
        </p>
        <p>
            <span class="fw-bold">Monto:</span>
            <span>{{ $factura->avisoCobro->monto_total }}$</span>
        </p>
        <p>
            <span class="fw-bold">Emitido el:</span>
            <span>{{ $factura->avisoCobro->created_at->format('Y-m-d') }}</span>
        </p>
        <p>
            <span class="fw-bold">Fecha límite:</span>
            <span>{{ $factura->avisoCobro->created_at->format('Y-m-d') }}</span>
        </p>
        <hr>
        <a target="_blank" href="{{ route('files.getFile', ['dir' => 'invoices', 'path' => $factura->invoice_path]) }}" class="btn btn-primary">
            <i class="fa fa-file-invoice"></i>
            Descargar factura
        </a>
    </div>
  </div>
@endsection