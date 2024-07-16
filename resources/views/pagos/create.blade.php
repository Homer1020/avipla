@extends('layouts.dashboard')
@section('title', 'Pago de factura')
@push('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
@endpush
@section('content')
  <h1 class="mt-4">Pago de factura</h1>
  <ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('pagos.index') }}">Estado de cuenta</a></li>
    <li class="breadcrumb-item"><a href="{{ route('pagos.invoice', $avisoCobro) }}">Aviso de cobro #{{ $avisoCobro->codigo_aviso }}</a></li>
    <li class="breadcrumb-item active">Adjuntar pago</li>
  </ol>
  
  <div class="row mb-4">
    <div class="col-12">
        <a class="btn btn-primary mb-3" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
            <i class="fa fa-info-circle"></i>
            Leer instrucciones de pago
        </a>
        <div class="collapse" id="collapseExample">
            <div class="alert alert-info">
                <h6>Estimado Afiliado,</h6>

                <p>Queremos informarle que ya puede realizar el pago correspondiente al mes en curso de la cuota de mantenimiento. Le invitamos a realizar el pago y reportarlo a través del formulario que encontrará a continuación.</p>

                <p>El monto de la cuota puede ser cancelado en dólares en efectivo en nuestra sede, o abonado en las cuentas bancarias señaladas más adelante mediante depósito o transferencia, a la tasa de cambio BCV del día en que se haga efectivo el pago.</p>

                <p>Le recordamos que todo aviso de cobro atrasado deberá ser cancelado a la tasa de cambio BCV del día en que realice la transacción de pago correspondiente.</p>

                {{-- <p>Para facilitar el proceso, por favor reporte su pago en el formulario que se encuentra a continuación.</p> --}}

                <p>A través de esta notificación, nuestros afiliados pueden registrar el abono contablemente en sus libros como un "ADELANTO A CUOTA TRIMESTRAL AVIPLA", y regularizar el mismo una vez recibida la factura correspondiente.</p>

                <p>Las transferencias ÚNICA Y EXCLUSIVAMENTE, a nombre de "Asociación Venezolana de Industrias Plásticas - AVIPLA", Rif J-00126013-7, en los siguientes bancos:</p>

                <ul>
                    <li>BANESCO: Cuenta Corriente N° 0134-0033-49-0331032580</li>
                    <li>BNC: Cuenta Corriente N° 0191-0098-76-2198407073</li>
                    <li>Bancaribe: Cuenta Corriente N° 0114-0174-13-1740077836</li>
                    <li>Mantenga al día sus obligaciones con AVIPLA y contribuya así con el desarrollo de nuestra industria plástica.</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-lg-6 mb-4 mb-lg-0">
        <p class="fw-bold text-uppercase text-muted">Formulario de pago</p>
        <div class="card">
            <div class="card-body">
                <form action="{{ route('pagos.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="aviso_cobro_id" value="{{ $avisoCobro->id }}">
                    <div class="mb-3">
                        <label for="metodo_pago_id" class="form-label">Método de pago <span class="text-danger fw-bold">*</span></label>
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
                        <label class="form-label" for="monto">Monto <span class="text-danger fw-bold">*</span></label>
                        <input
                            name="monto"
                            id="monto"
                            type="number"
                            class="form-control @error('monto') is-invalid @enderror"
                            value="{{ old('monto') }}"
                            placeholder="Ingrese el monto"
                            step="0.01"
                        >
                        @error('monto')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="banco_id" class="form-label">Banco emisor</label>
                        <select
                            name="banco_id"
                            id="banco_id"
                            class="form-select @error('banco_id') is-invalid @enderror"
                        >
                            <option selected disabled>Seleccion el banco emisor</option>
                            @foreach ($bancos as $banco)
                                <option
                                    value="{{ $banco->id }}"
                                    @selected(intval(old('banco_id')) === $banco->id)
                                >{{ $banco->codigo }} - {{ $banco->nombre }}</option>
                            @endforeach
                        </select>
                        @error('banco_id')
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
                        <label for="tasa" class="form-label">Tasa en Bs's</label>
                        <input
                            name="tasa"
                            id="tasa"
                            type="number"
                            step="0.01"
                            class="form-control @error('tasa') is-invalid @enderror"
                            value="{{ old('tasa') }}"
                            placeholder="Ingrese la tasa en bolivares"
                        >
                        @error('tasa')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="referencia" class="form-label">Fecha de pago <span class="text-danger fw-bold">*</span></label>
                        <input
                            name="fecha_pago"
                            id="fecha_pago"
                            type="date"
                            class="form-control @error('fecha_pago') is-invalid @enderror"
                            value="{{ old('fecha_pago') }}"
                            placeholder="Ingrese el número de fecha_pago"
                            max="{{ date('Y-m-d') }}"
                        >
                        @error('fecha_pago')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="comprobante" class="form-label">Comprobante <span class="text-danger fw-bold">*</span></label>
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
        <p class="fw-bold text-uppercase text-muted">Aviso de cobro</p>
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
                <span class="fw-bold">Monto total:</span>
                {{ $avisoCobro->monto_total }}$
            </li>
            <li class="list-group-item">
                <span class="fw-bold">Estado:</span>
                @switch($avisoCobro->estado)
                  @case('COMPLETADO')
                    <div class="badge bg-success">
                      {{ $avisoCobro->estado }}
                    </div>
                    @break
                  @case('PENDIENTE')
                    <div class="badge bg-warning">
                      {{ $avisoCobro->estado }}
                    </div>
                    @break
                  @case('CANCELADO')
                    <div class="badge bg-danger">
                      {{ $avisoCobro->estado }}
                    </div>
                    @break
                  @default
                    <div class="badge bg-secondary">
                      {{ $avisoCobro->estado }}
                    </div>
                @endswitch
            </li>
        </ul>
    </div>
  </div>
@endsection
@push('script')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#banco_id').select2({
                theme: 'bootstrap-5'
            })

            $("#monto").on({
                "focus": function (event) {
                    $(event.target).select();
                },
                "keyup": function (event) {
                    $(event.target).val(function (index, value ) {
                        return value.replace(/\D/g, "")
                                    .replace(/([0-9])([0-9]{2})$/, '$1.$2')
                                    .replace(/\B(?=(\d{10})+(?!\d)\.?)/g, ",");
                    });
                }
            });

            $("#tasa").on({
                "focus": function (event) {
                    $(event.target).select();
                },
                "keyup": function (event) {
                    $(event.target).val(function (index, value ) {
                        return value.replace(/\D/g, "")
                                    .replace(/([0-9])([0-9]{2})$/, '$1.$2')
                                    .replace(/\B(?=(\d{10})+(?!\d)\.?)/g, ",");
                    });
                }
            });
        })
    </script>
@endpush