@extends('layouts.dashboard')
@section('title', 'Modificar pago')
@section('content')
  <h1 class="mt-4">Modificar pago</h1>
  <ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('pagos.index') }}">Estado de cuenta</a></li>
    {{-- <li class="breadcrumb-item"><a href="{{ route('pagos.invoice', $pago->avisoCobro) }}">Factura #{{ $pago->avisoCobro->numero_factura }}</a></li> --}}
    <li class="breadcrumb-item active">Modificar pago</li>
  </ol>
  
  <div class="row mb-4">
    <div class="col-lg-6 mb-4 mb-lg-0">
        <p class="fw-bold text-uppercase text-muted">Formulario de pago</p>
        <div class="card">
            <div class="card-body">
                <form action="{{ route('pagos.update', $pago) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="aviso_cobro_id" value="{{ $pago->avisoCobro->id }}">
                    <div class="mb-3">
                        <label for="metodo_pago_id" class="form-label">Método de pago</label>
                        <select
                            required
                            name="metodo_pago_id"
                            id="metodo_pago_id"
                            class="form-select @error('metodo_pago_id') is-invalid @enderror"
                        >
                            <option selected disabled>Seleccion un metodo de pago</option>
                            @foreach ($metodos_pago as $metodo)
                                <option
                                    value="{{ $metodo->id }}"
                                    @selected(intval(old('metodo_pago_id', $pago->metodo_pago_id)) === $metodo->id)
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
                            required
                            name="monto"
                            id="monto"
                            type="text"
                            class="form-control @error('monto') is-invalid @enderror"
                            value="{{ old('monto', $pago->monto) }}"
                            placeholder="Ingrese el monto"
                        >
                        @error('monto')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="referencia" class="form-label">Referencia</label>
                        <input
                            required
                            name="referencia"
                            id="referencia"
                            type="text"
                            class="form-control @error('referencia') is-invalid @enderror"
                            value="{{ old('referencia', $pago->referencia) }}"
                            placeholder="Ingrese el número de referencia"
                        >
                        @error('referencia')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <p class="form-label">Comprobante</p>
                        <a target="_blank" href="{{ route('files.getFile', ['dir' => 'comprobantes', 'path' => $pago->comprobante]) }}" class="btn btn-outline-primary me-2">
                            <i class="fa fa-file"></i>
                            Ver comprobante actual
                        </a>
                    </div>

                    <div class="mb-3">
                        <label for="comprobante" class="form-label">Comprobante nuevo</label>
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
                    <button type="submit" class="btn btn-warning mt-4">
                        <i class="fas fa-money-bill-alt"></i>
                        Actualizar pago
                    </button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <p class="fw-bold text-uppercase text-muted">Aviso de cobro</p>
        <ul class="list-group mb-4">
            @php
                $avisoCobro = $pago->avisoCobro;
            @endphp
            <li class="list-group-item">
                <span class="fw-bold">Código:</span>
                #{{ $avisoCobro->numero_factura }}
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
                <span class="fw-bold d-block mb-2">Documento:</span>
                <a target="_blank" href="{{ route('files.getFile', ['dir' => 'avisos-cobros', 'path' => $avisoCobro->documento]) }}" class="btn btn-outline-primary">
                    <i class="fa fa-file"></i>
                    Documento
                </a>
            </li>
            <li class="list-group-item">
                <span class="fw-bold">Estado:</span>
                @include('partials.invoice_status')
            </li>
            <li class="list-group-item">
                <span class="fw-bold">Observaciones:</span>
                {{ $avisoCobro->observaciones }}
            </li>
        </ul>
    </div>
  </div>
@endsection