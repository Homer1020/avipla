@extends('layouts.dashboard')
@section('title', 'Generar Aviso')
@push('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
@endpush
@section('content')
  <h1 class="mt-4">Generar Aviso</h1>
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
            <label for="numero_factura" class="form-label">Número de aviso</label>
            <input
                type="number"
                class="form-control @error('numero_factura') is-invalid @enderror"
                name="numero_factura"
                id="numero_factura"
                value="{{ old('numero_factura') }}"
                required
                placeholder="102030"
            >
            @error('numero_factura')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="afiliado_id" class="form-label">Afiliado</label>
            <select
                class="selectpicker w-100 @error('afiliado_id') is-invalid @enderror"
                name="afiliado_id"
                id="afiliado_id"
                data-placeholder="Seleccione un afiliado"
                required
            >
                <option></option>
                @foreach ($afiliados as $afiliado)
                    <option {{ intval(old('afiliado_id')) === $afiliado->id ? 'selected' : '' }} value="{{ $afiliado->id }}">{{ $afiliado->razon_social }}</option>
                @endforeach
            </select>
            @error('afiliado_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="monto_total" class="form-label">Monto (en dolares)</label>
            <input
                type="number"
                class="form-control @error('monto_total') is-invalid @enderror"
                name="monto_total"
                id="monto_total"
                value="{{ old('monto_total') }}"
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

        <div class="mb-3">
            <label for="documento" class="form-label">Documento</label>
            <input
                type="file"
                name="documento"
                id="documento"
                class="form-control @error('documento') is-invalid @enderror"
                accept=".pdf"
                required
            >
            @error('documento')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary mt-4">Generar aviso</button>
      </div>
    </div>
  </form>
@endsection
@push('script')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#afiliado_id').select2({
                theme: 'bootstrap-5'
            })
        })

        var now = new Date(),
        minDate = now.toISOString().substring(0,10);
        $('#fecha_limite').prop('min', minDate);
    </script>
@endpush