@extends('layouts.dashboard')
@section('title', 'Detalle Factura')
@section('content')
  <h1 class="mt-4">Detalles del pago</h1>
  <ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('pagos.index') }}">Estado de cuenta</a></li>
    <li class="breadcrumb-item active">Detalles del pago</li>
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
                <span class="fw-bold">Fecha de emisión:</span>
                {{ $invoice->created_at }}
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
        <p class="fw-bold text-uppercase text-muted">Usuario emisor</p>
        <ul class="list-group mb-4">
            <li class="list-group-item">
                <span class="fw-bold">Nombre:</span>
                {{ $invoice->user->name }}
            </li>
            <li class="list-group-item">
                <span class="fw-bold">Correo:</span>
                <a href="mailto:{{ $invoice->user->email }}">{{ $invoice->user->email }}</a>
            </li>
        </ul>

        <p class="fw-bold text-uppercase text-muted">Datos del afiliado</p>
        <ul class="list-group">
            <li class="list-group-item">
                <span class="fw-bold">Empresa:</span>
                {{ $invoice->afiliado->razon_social }}
            </li>
            <li class="list-group-item">
                <span class="fw-bold">Correo:</span>
                <a href="mailto:{{ $invoice->afiliado->user->email }}">{{ $invoice->afiliado->user->email }}</a>
            </li>
        </ul>
    </div>
  </div>
@endsection