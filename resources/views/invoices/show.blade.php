@extends('layouts.dashboard')
@section('title', 'Detalle Factura')
@section('content')
  <h1 class="mt-4">Detalle Factura</h1>
  <ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('invoices.index') }}">Facturas</a></li>
    <li class="breadcrumb-item active">Detalle Factura</li>
  </ol>
  
  <div class="row">
      <div class="col-lg-6">
        <p class="fw-bold text-uppercase text-muted">Datos de factura</p>
        <ul class="list-group">
            <li class="list-group-item">
                <span class="fw-bold">Código:</span>
                #{{ $invoice->numero_factura }}
            </li>
            <li class="list-group-item">
                <span class="fw-bold">Monto total:</span>
                {{ $invoice->monto_total }}$
            </li>
            <li class="list-group-item">
                <span class="fw-bold">Documento:</span>
                <a target="_blank" href="{{ route('files.getFile', ['dir' => 'invoices', 'path' => $invoice->documento]) }}">{{ $invoice->documento }}</a>
            </li>
            <li class="list-group-item">
                <span class="fw-bold">Estado:</span>
                <span class="badge bg-warning">
                    {{ $invoice->estado }}
                </span>
            </li>
        </ul>
    </div>
    <div class="col-lg-6">
        <p class="fw-bold text-uppercase text-muted">Datos del afiliado</p>
        <ul class="list-group">
            <li class="list-group-item">
                <span class="fw-bold">Empresa:</span>
                {{ $invoice->afiliado->razon_social }}
            </li>
            <li class="list-group-item">
                <span class="fw-bold">Correo:</span>
                <a href="mailto:{{ $invoice->afiliado->correo }}">{{ $invoice->afiliado->correo }}</a>
            </li>
        </ul>
    </div>
  </div>
@endsection