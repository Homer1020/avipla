<!-- Modal -->
@if ($avisoCobro->pago)
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Generar factura trimestral</h5>
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

                        <label for="monto_total" class="form-label">Monto total</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text">$</span>
                            <input
                                type="number"
                                name="monto_total"
                                id="monto_total"
                                placeholder="00,00"
                                class="form-control"
                                step="0.01"
                            >
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


@canany(['create_factura', 'view_factura'])
    <div class="d-flex justify-content-end {{ $avisoCobro->pago || $avisoCobro->invoice ? 'mb-3' : '' }}">
        @if ($avisoCobro->pago && !$avisoCobro->invoice && Auth::user()->can('create_factura'))
            <button type="button" id="btn-invoice" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fas fa-file-invoice"></i> Generar factura trimestral</button>
        @endif
        <div class="d-inline-block" id="invoice_button_wrapper">
            @if ($avisoCobro->invoice && Auth::user()->can('view_factura'))
                <a target="_blank" href="{{ route('files.getFile', ['dir' => 'invoices', 'path' => $avisoCobro->invoice->invoice_path]) }}" class="btn btn-primary">
                    <i class="fas fa-file-invoice"></i>
                    Ver factura trimestral
                </a>
            @endif
        </div>
    </div>
@endcanany

<div class="row">
    @if ($avisoCobro->pago)
        <div class="col-lg-6">
            @php
                $pago = $avisoCobro->pago;
            @endphp
            <p class="fw-bold text-uppercase">Datos del pago</p>
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
                    <span class="fw-bold">Tasa:</span>
                    {{ $avisoCobro->pago->tasa }} Bs.s
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
                    <span class="fw-bold">Empresa:</span>
                    <a href="mailto:{{ $avisoCobro->afiliado->user->email }}">{{ $avisoCobro->afiliado->razon_social }}</a>
                </li>
                <li class="list-group-item">
                    <span class="fw-bold">Fecha de pago:</span>
                    {{ $pago->fecha_pago }}
                </li>
                @if ($pago->comprobante)
                    <li class="list-group-item d-flex">
                        <a target="_blank" href="{{ route('files.getFile', ['dir' => 'comprobantes', 'path' => $pago->comprobante]) }}" class="btn btn-outline-primary">
                            <i class="fa fa-file"></i>
                            Comprobante
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    @endif
    <div class="{{ !$avisoCobro->pago ? 'col-lg-12' : 'col-lg-6' }}">
        <p class="fw-bold text-uppercase">Datos del aviso</p>
        <ul class="list-group mb-4">
            <li class="list-group-item">
                <span class="fw-bold">Código:</span>
                #{{ $avisoCobro->codigo_aviso }}
            </li>
            <li class="list-group-item">
                <span class="fw-bold">Fecha de emisión:</span>
                {{ $avisoCobro->created_at }}
            </li>
            @if (!$avisoCobro->pago)
                <li class="list-group-item">
                    <span class="fw-bold">Empresa:</span>
                    <a href="mailto:{{ $avisoCobro->afiliado->user->email }}">{{ $avisoCobro->afiliado->razon_social }}</a>
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
            @can('update', $avisoCobro)
                <li class="list-group-item">
                    @php
                        $queryParams = request()->query();
                    @endphp
                    <form
                        onsubmit="handleSubmitForm(event.target, 'PATCH', function() {
                            invoicesTable.ajax.reload(null, false)
                            modal.hide()
                        }); return false;"
                        action="{{ route('avisos-cobro.update', $avisoCobro) }}"
                        method="POST"
                    >
                        <div class="mb-3">
                            <label class="form-label fw-bold">Estado:</label>
                            <select
                                @disabled(Auth::user()->cannot('update_aviso'))
                                name="invoice_status" id="invoice_status"
                                class="form-select"
                            >
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
                    </form>
                </li>
            @else
                <li class="list-group-item">
                    <span class="fw-bold">Estado:</span>
                    @include('partials.invoice_status')
                </li>
                @if($avisoCobro->observaciones)
                    <li class="list-group-item">
                        <span class="fw-bold">Observaciones:</span>
                        {{ $avisoCobro->observaciones }}
                    </li>
                @endif
                @if (!$avisoCobro->pago)
                    <li class="list-group-item">
                        <span class="fw-bold d-block mb-2">Adjuntar pago:</span>
                        <a href="{{ route('avisos-cobro.payCollectionNotice', $avisoCobro) }}" type="submit" class="btn btn-primary">
                            <i class="fas fa-file-invoice"></i>
                            Adjuntar pago
                        </a>
                    </li>
                @endif
            @endcan
        </ul>
    </div>
</div>