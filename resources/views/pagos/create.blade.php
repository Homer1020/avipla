@extends('layouts.dashboard')
@section('title', 'Pago de factura')
@section('content')
  <h1 class="mt-4">Pago de factura</h1>
  <ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('pagos.index') }}">Estado de cuenta</a></li>
    <li class="breadcrumb-item"><a href="{{ route('pagos.invoice', $invoice) }}">Factura #{{ $invoice->numero_factura }}</a></li>
    <li class="breadcrumb-item active">Detalle del pago</li>
  </ol>
  
  <div class="row mb-4">
    <div class="col-lg-6 mb-4 mb-lg-0">
        <p class="fw-bold text-uppercase text-muted">Formulario de pago</p>
        <div class="card">
            <div class="card-body">
                <form action="{{ route('pagos.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="invoice_id" value="{{ $invoice->id }}">
                    <div class="mb-3">
                        <label for="metodo_pago_id" class="form-label">Método de pago</label>
                        <select
                            name="metodo_pago_id"
                            id="metodo_pago_id"
                            class="form-select @error('metodo_pago_id') is-invalid @enderror"
                        >
                            <option selected disabled>Seleccion un metodo de pago</option>
                            @foreach ($metodos_pago as $metodo)
                                <option
                                    value="{{ $metodo->id }}"
                                    @selected(intval(old('metodo_pago_id')) === $metodo->id)
                                >{{ $metodo->metodo_pago }}</option>
                            @endforeach
                        </select>
                        @error('metodo_pago_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="monto">Monto</label>
                        <input
                            name="monto"
                            id="monto"
                            type="text"
                            class="form-control @error('monto') is-invalid @enderror"
                            value="{{ old('monto') }}"
                            placeholder="Ingrese el monto"
                        >
                        @error('monto')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="referencia" class="form-label">Referencia</label>
                        <input
                            name="referencia"
                            id="referencia"
                            type="text"
                            class="form-control @error('referencia') is-invalid @enderror"
                            value="{{ old('referencia') }}"
                            placeholder="Ingrese el número de referencia"
                        >
                        @error('referencia')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="comprobante" class="form-label">Comprobante</label>
                        <input
                            type="file"
                            name="comprobante"
                            id="comprobante"
                            class="form-control @error('comprobante') is-invalid @enderror"
                        >
                        @error('comprobante')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-outline-success mt-4">
                        <i class="fas fa-money-bill-alt"></i>
                        Pagar factura
                    </button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
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
                <span class="fw-bold d-block mb-2">Documento:</span>
                <a target="_blank" href="{{ route('files.getFile', ['dir' => 'invoices', 'path' => $invoice->documento]) }}" class="btn btn-outline-primary">
                    <i class="fa fa-file"></i>
                    Documento
                </a>
            </li>
            <li class="list-group-item">
                <span class="fw-bold">Estado:</span>
                @switch($invoice->estado)
                  @case('COMPLETADO')
                    <div class="badge bg-success">
                      {{ $invoice->estado }}
                    </div>
                    @break
                  @case('PENDIENTE')
                    <div class="badge bg-warning">
                      {{ $invoice->estado }}
                    </div>
                    @break
                  @case('CANCELADO')
                    <div class="badge bg-danger">
                      {{ $invoice->estado }}
                    </div>
                    @break
                  @default
                    <div class="badge bg-secondary">
                      {{ $invoice->estado }}
                    </div>
                @endswitch
            </li>
        </ul>
    </div>
  </div>
@endsection