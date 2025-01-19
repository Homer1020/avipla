@extends('layouts.dashboard')
@section('title', 'Generar Aviso')
@push('css')
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
@endpush
@section('content')
  <h1 class="mt-4 fs-4">Generar Aviso</h1>
  <ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('avisos-cobro.index') }}">Avisos de cobro</a></li>
    <li class="breadcrumb-item active">Generar Aviso</li>
  </ol>

  <form novalidate action="{{ route('avisos-cobro.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="card mb-4">
      <div class="card-body">
        <div class="mb-3">
          <label for="codigo_aviso" class="form-label">Código del aviso</label>
          <input
            type="text"
            class="form-control @error('codigo_aviso') is-invalid @enderror"
            name="codigo_aviso"
            id="codigo_aviso"
            value="{{ old('codigo_aviso', App\Models\AvisoCobro::getCurrentCodigoAviso()) }}"
            required
            placeholder="{{ App\Models\AvisoCobro::getCurrentCodigoAviso() }}"
          >
          @error('aviso_code')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <div class="mb-3">
          <label for="afiliado_id" class="form-label">Afiliado</label>
          <select name="afiliado_id" id="afiliado_id" class="form-select">
            <option value=""></option>
            @foreach ($afiliados as $afiliado)
              <option value="{{ $afiliado->id }}">{{ $afiliado->razon_social }}</option>
            @endforeach
          </select>
          <div class="form-text">Si se deja vacío se aplicara masivamente a los afiliados que no tenga un aviso de cobro con el código</div>
        </div>
        
        <div class="mb-3">
            <label for="monto_total" class="form-label">Monto (en dólares)</label>
            <input
                autofocus
                type="number"
                class="form-control @error('monto_total') is-invalid @enderror"
                name="monto_total"
                id="monto_total"
                value="{{ old('monto_total', '100.00') }}"
                required
                placeholder="100"
            >
            @error('monto_total')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="fecha_limite" class="form-label">Fecha límite (opcional)</label>
            <input
                type="date"
                class="form-control @error('fecha_limite') is-invalid @enderror"
                name="fecha_limite"
                id="fecha_limite"
                value="{{ old('fecha_limite') }}"
            >
            @error('fecha_limite')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary mt-4">Generar aviso</button>
      </div>
    </div>
  </form>
@endsection
@push('script')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#afiliado_id').select2({
                theme: 'bootstrap-5',
                placeholder: 'Seleccione un afiliado',
                allowClear: true
            })
        })

        var now = new Date(),
        minDate = now.toISOString().substring(0,10);
        $('#fecha_limite').prop('min', minDate);

        $("#monto_total").on({
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
    </script>
@endpush