@extends('layouts.dashboard')
@section('title', 'Generar factura')
@push('css')
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
@endpush
@section('content')
  <h1 class="mt-4">Generar factura</h1>
  <ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('invoices.index') }}">Facturas</a></li>
    <li class="breadcrumb-item active">Generar factura</li>
  </ol>

  <div class="card">
    <div class="card-body">
        <form novalidate action="{{ route('invoices.formStore') }}" method="POST" id="invoice-form" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
              <label for="aviso_cobro_id" class="form-label">Aviso de cobro <span class="fw-bold text-danger">*</span></label>
              <select class="selectpicker @error('aviso_cobro_id') is-invalid @enderror w-100" name="aviso_cobro_id" id="aviso_cobro_id" data-placeholder="Seleccione un recibo">
                <option></option>
                @foreach ($avisosCobro as $avisoCobro)
                  <option value="{{ $avisoCobro->id }}">{{ $avisoCobro->afiliado->razon_social }} - #{{ $avisoCobro->codigo_aviso }}</option>
                @endforeach
              </select>
              <div id="aviso_cobro_id_help" class="form-text">Avisos de cobro en estado de revisión.</div>
              @error('aviso_cobro_id')
                <span class="invalid-feedback">{{ $message }}</span>
              @enderror 
            </div>
            <label for="numero_factura" class="form-label">Número de factura <span class="text-danger fw-bold">*</span></label>
            <div class="input-group mb-3">
                <span class="input-group-text">#</span>
                <input name="numero_factura" required id="numero_factura" type="number" class="form-control @error('numero_factura') is-invalid @enderror" placeholder="10203010">
                @error('numero_factura')
                  <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div> 
            
            <label for="monto_total" class="form-label">Monto total <span class="text-danger fw-bold">*</span></label>
            <div class="input-group mb-3">
                <span class="input-group-text">$</span>
                <input name="monto_total" required id="monto_total" type="number" class="form-control @error('monto_total') is-invalid @enderror" placeholder="100"> 
                @error('monto_total')
                  <span class="invalid-feedback">{{ $message }}</span>
                @enderror   
            </div> 
    
            <div class="mb-3">
                <label for="invoice_path" class="form-label">Cargar factura <span class="text-danger fw-bold">*</span></label>
                <input required type="file" name="invoice_path" id="invoice_path" class="form-control @error('invoice_path') is-invalid @enderror">
                @error('invoice_path')
                  <span class="invalid-feedback">{{ $message }}</span>
                @enderror 
            </div>
    
            <div class="mb-3">
                <label for="observaciones" class="form-label">Observaciones</label>
                <textarea placeholder="Ingrese una observación (Opcional)" rows="3" required name="observaciones" id="observaciones" class="form-control @error('observaciones') is-invalid @enderror"></textarea>
                @error('observaciones')
                  <span class="invalid-feedback">{{ $message }}</span>
                @enderror 
            </div>

            <button type="submit" class="btn btn-primary">
              <i class="fa fa-file-invoice"></i>
              Generar factura
            </button>
        </form>
    </div>
  </div>
@endsection
@push('script')
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#aviso_cobro_id').select2({
        theme: 'bootstrap-5'
      })
    })
  </script>
@endpush