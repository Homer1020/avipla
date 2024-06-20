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
                <a target="_blank" href="{{ route('files.getFile', ['dir' => 'invoices', 'path' => $invoice->documento]) }}" class="btn btn-outline-primary">
                    <i class="fa fa-file"></i>
                    Documento
                </a>
            </li>
            <li class="list-group-item">
                <form action="{{ route('invoices.update', $invoice) }}" method="POST">
                    @method('PATCH')
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-bold">Estado:</label>
                        <select name="invoice_status" id="invoice_status" class="form-select">
                            <option selected disabled>Cambiar estado</option>
                            <option value="COMPLETADO" @selected($invoice->estado === 'COMPLETADO')>COMPLETADO</option>
                            <option value="PENDIENTE" @selected($invoice->estado === 'PENDIENTE')>PENDIENTE</option>
                            <option value="CANCELADO" @selected($invoice->estado === 'CANCELADO')>CANCELADO</option>
                            <option value="REVISION" @selected($invoice->estado === 'REVISION')>REVISION</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="observaciones" class="fw-bold form-label">Observaciones:</label>
                        <textarea
                            name="observaciones"
                            id="observaciones"
                            rows="2"
                            class="form-control @error('observaciones') is-invalid @enderror"
                        >{{ old('observaciones', $invoice->observaciones) }}</textarea>
                        @error('is-invalid')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div id="submit_button"></div>
                </form>
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
@push('script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const $invoice_status = $('#invoice_status')
        const initial_value = $invoice_status.val()
        $('#invoice_status').on('change', function() {
            const current_value = $('#invoice_status').val()
            if(current_value !== initial_value && !($('#submit_button button').length)) {
                $('#submit_button').append(`
                    <button type="submit" class="btn btn-outline-success"><i class="fa fa-check"></i> Guardar estado</button>
                `)
            } else if(current_value === initial_value) {
                $('#submit_button > *').remove()
            }
        });
    </script>
  
    @if (session('success'))
      <script>
          Swal.fire({
              icon: "success",
              title: "{{ session('success') }}"
          });
      </script>
    @endif
@endpush