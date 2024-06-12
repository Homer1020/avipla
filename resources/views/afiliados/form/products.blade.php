<p class="fw-bold text-uppercase text-muted">Productos y servicios</p>
<div class="row mb-3">
  <div class="col-lg-6">
    <label for="productos" class="form-label">Linea de productos</label>
    <select
      multiple
      class="form-select w-100 @error('productos') is-invalid @enderror"
      name="productos[]"
      id="productos"
      data-placeholder="Seleccione uno o varios productos"
    >
      <option></option>
      @foreach ($productos as $producto)
        <option value="{{ $producto->id }}">{{ $producto->nombre }}</option>
      @endforeach
    </select>
    @error('productos')
      <div class="invalid-feedback">{{ $message }}</div>
    @enderror
  </div>
  <div class="col-lg-6">
    <label for="materias_primas" class="form-label">Principales materias primas utilizadas</label>
    <select
      multiple
      class="form-select w-100 @error('materias_primas') is-invalid @enderror"
      name="materias_primas[]"
      id="materias_primas"
      data-placeholder="Seleccione una o varias materias primas"
    >
      <option></option>
      @foreach ($materias_primas as $materia_prima)
        <option value="{{ $materia_prima->id }}">{{ $materia_prima->materia_prima }}</option>
      @endforeach
    </select>
    @error('materias_primas')
      <div class="invalid-feedback">{{ $message }}</div>
    @enderror
  </div>
  <div class="col-lg-12" id="products_details">
      
  </div>
</div>

<div class="row mb-3">
  <div class="col-lg-6">
    <label for="servicios" class="form-label">Servicios prestados</label>
    <select
      multiple
      class="form-select w-100 @error('servicios') is-invalid @enderror"
      name="servicios[]"
      id="servicios"
      data-placeholder="Seleccione una o varias materias primas"
    >
      <option></option>
      @foreach ($servicios as $servicio)
        <option value="{{ $servicio->id }}">{{ $servicio->nombre_servicio }}</option>
      @endforeach
    </select>
    @error('servicios')
      <div class="invalid-feedback">{{ $message }}</div>
    @enderror
  </div>
  <div class="col-lg-6">
    <label for="afiliados" class="form-label">Empresas asociadas a AVIPLA que la refieren</label>
    <select
      multiple
      class="form-select w-100 @error('afiliados') is-invalid @enderror"
      name="afiliados[]"
      id="afiliados"
      data-placeholder="Seleccione una o varias materias primas"
    >
      <option></option>
      @foreach ($afiliados as $afiliado)
        <option value="{{ $afiliado->id }}">{{ $afiliado->razon_social }}</option>
      @endforeach
    </select>
    @error('afiliados')
      <div class="invalid-feedback">{{ $message }}</div>
    @enderror
  </div>
</div>