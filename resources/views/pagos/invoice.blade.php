@extends('layouts.dashboard')
@section('title', 'Detalle Factura')
@section('content')
  <h1 class="mt-4">Detalles del pago</h1>
  <ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('pagos.index') }}">Estado de cuenta</a></li>
    <li class="breadcrumb-item active">Factura #{{ $invoice->numero_factura }}</li>
  </ol>
  <div class="row">
      <div class="col-lg-6">
        @if ($invoice->pago)
            @php
                $pago = $invoice->pago;
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
                <span class="fw-bold">Estado:</span>
                @include('partials.invoice_status')
            </li>
            <li class="list-group-item">
                <span class="fw-bold">Observaciones:</span>
                {{ $invoice->observaciones }}
            </li>
            
            @if (!$invoice->pago)
                @can('update', $invoice)
                    <li class="list-group-item">
                        <span class="fw-bold d-block mb-2">Pagar factura:</span>
                        <a href="{{ route('pagos.pay_invoice', $invoice) }}" type="submit" class="btn btn-primary">
                            <i class="fas fa-file-invoice"></i>
                            Pagar factura
                        </a>
                    </li>
                @endcan
            @endif
            <li class="list-group-item">
                <span class="fw-bold d-block mb-2">Documento:</span>
                <a target="_blank" href="{{ route('files.getFile', ['dir' => 'invoices', 'path' => $invoice->documento]) }}" class="btn btn-outline-primary">
                    <i class="fa fa-file"></i>
                    Documento
                </a>
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