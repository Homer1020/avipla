@extends('layouts.dashboard')
@section('title', 'Detalle del aviso')
@section('content')
  <h1 class="mt-4">Detalle del aviso</h1>
  <ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('avisos-cobro.index') }}">Avisos de cobro</a></li>
    <li class="breadcrumb-item active">Detalle del aviso</li>
  </ol>

    <!-- Modal -->
    @if ($avisoCobro->pago)
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Generar factura</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form novalidate action="{{ route('invoices.store') }}" method="POST" id="invoice-form" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="aviso_cobro_id" value="{{ $avisoCobro->id }}">
                            <input type="hidden" name="pago_id" value="{{ $avisoCobro->pago->id }}">
                            <label for="numero_factura" class="form-label">Número de factura <span class="text-danger fw-bold">*</span></label>
                            <div class="input-group mb-3">
                                <span class="input-group-text">#</span>
                                <input name="numero_factura" required id="numero_factura" type="number" class="form-control" placeholder="10203010">    
                            </div> 
                            
                            <label for="monto_total" class="form-label">Monto total <span class="text-danger fw-bold">*</span></label>
                            <div class="input-group mb-3">
                                <span class="input-group-text">$</span>
                                <input name="monto_total" required id="monto_total" type="number" class="form-control" placeholder="100">    
                            </div> 

                            <div class="mb-3">
                                <label for="invoice_path" class="form-label">Cargar factura <span class="text-danger fw-bold">*</span></label>
                                <input required type="file" name="invoice_path" id="invoice_path" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label for="observaciones" class="form-label">Observaciones</label>
                                <textarea placeholder="Ingrese una observación (Opcional)" rows="3" required name="observaciones" id="observaciones" class="form-control"></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="fa fa-times"></i>
                            Cerrar
                        </button>
                        <button form="invoice-form" type="submit" class="btn btn-success">
                            <i class="fas fa-save"></i>
                            Generar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
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
                    <span class="fw-bold">Referencia:</span>
                    {{ $pago->referencia }}
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
                <li class="list-group-item">
                    <a target="_blank" href="{{ route('files.getFile', ['dir' => 'comprobantes', 'path' => $pago->comprobante]) }}" class="btn btn-outline-primary">
                        <i class="fa fa-file"></i>
                        Comprobante
                    </a>
                </li>
            </ul>
        </div>
    @endif
    <div class="col-lg-6">
        <p class="fw-bold text-uppercase text-muted">Datos del aviso</p>
        <ul class="list-group mb-4">
            <li class="list-group-item">
                <span class="fw-bold">Código:</span>
                #{{ $avisoCobro->numero_factura }}
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
            @if (!$avisoCobro->pago)
                <li class="list-group-item">
                    <span class="fw-bold">Empresa:</span>
                    {{ $avisoCobro->afiliado->razon_social }}
                </li>
                <li class="list-group-item">
                    <span class="fw-bold">Correo de la epmpresa:</span>
                    <a href="mailto:{{ $avisoCobro->afiliado->user->email }}">{{ $avisoCobro->afiliado->user->email }}</a>
                </li>
            @endif
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
                            <option value="REVISION" @selected($avisoCobro->estado === 'REVISION')>REVISIÓN</option>
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
                    @if ($avisoCobro->pago && !$avisoCobro->invoice)
                        <button type="button" id="btn-invoice" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fas fa-file-invoice"></i> Generar factura</button>
                    @endif
                    <div class="d-inline-block" id="invoice_button_wrapper">
                        @if ($avisoCobro->invoice)
                            <a target="_blank" href="{{ route('files.getFile', ['dir' => 'invoices', 'path' => $avisoCobro->invoice->invoice_path]) }}" class="btn btn-outline-primary">
                                <i class="fa fa-eye"></i>
                                Ver factura
                            </a>
                        @endif
                    </div>
                </form>
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
          })
      </script>
    @endif
    <script>
        $('#invoice-form').on('submit', function(event) {
            event.preventDefault()

            const fd = new FormData(event.target);

            fetch(event.target.action, {
                method: 'POST',
                body: fd
            })
            .then(response => response.json())
            .then(response => {
                const { data, success } = response
                if(!success) {
                    <!-- RESET VALIDATIONS -->
                    $('input').each(function() {
                        $(this).parent().find('.invalid-feedback').remove()
                        $(this).removeClass('is-invalid')
                    })

                    <!-- PRINT ERRORS -->
                    for (const name in data) {
                        const $input = $(`[name="${name}"]`)
                        $input.addClass('is-invalid')
                        $input.parent().append(`<span class="invalid-feedback">${ data[name][0] }</span>`)
                    }
                } else {
                    const buttonURL = '/uploads/invoices/' + data.invoice.invoice_path
                    $('#exampleModal').modal('hide')
                    $('#btn-invoice').remove()
                    $('#invoice_button_wrapper').append(`
                        <a target="_blank" href="${ buttonURL }" class="btn btn-outline-primary">
                            <i class="fa fa-eye"></i>
                            Ver factura
                        </a>
                    `)
                    Swal.fire({
                        icon: "success",
                        title: data.message
                    })
                }
            })
        })
    </script>
@endpush