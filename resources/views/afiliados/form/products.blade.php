<p class="fw-bold text-uppercase">Productos y servicios</p>

<div class="mb-3 mb-3">
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
      <option
        {{ in_array($producto->id, old('productos', $afiliado->productos ? $afiliado->productos->pluck(['id'])->all() : [])) ? 'selected' : '' }}
        value="{{ $producto->id }}"
      >
        {{ $producto->nombre }}
      </option>
    @endforeach
  </select>
  @error('productos')
    <div class="invalid-feedback">{{ $message }}</div>
  @enderror
</div>
<div id="products_details">
  @foreach (old('productos', $afiliado->productos) as $key => $producto)
    <div class="row" id="producto-{{ strtolower($productos->find($producto) ? $productos->find($producto)->nombre : $producto) }}">
      <div class="col-12">
        <p class="fw-bold text-uppercase">
          <small>Detalles de {{ $productos->find($producto) ? $productos->find($producto)->nombre : $producto }}</small>
        </p>
      </div>
      <div class="col-lg-4 mb-3">
        <input
          type="number"
          placeholder="Producción total mensual (TM)"
          name="produccion_total_mensual[]"
          class="form-control @error("produccion_total_mensual.$key") is-invalid @enderror"
          value="{{ old('produccion_total_mensual') ? old('produccion_total_mensual')[$key] : $producto->pivot->produccion_total_mensual }}"
        />
        <div class="form-text">Producción total mensual (TM)</div>
        @error("produccion_total_mensual.$key")
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>
      <div class="col-lg-4 mb-3">
        <input
          type="number"
          placeholder="Porcentaje destinados a exportación"
          name="porcentage_exportacion[]"
          class="form-control @error("porcentage_exportacion.$key") is-invalid @enderror"
          value="{{ old('porcentage_exportacion') ? old('porcentage_exportacion')[$key] : $producto->pivot->porcentage_exportacion }}"
        />
        <div class="form-text">Porcentaje destinados a exportación</div>
        @error("porcentage_exportacion.$key")
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>
      <div class="col-lg-4 mb-3">
        <input
          type="number"
          placeholder="Mercados de importación / exportación"
          name="mercado_exportacion[]"
          class="form-control @error("mercado_exportacion.$key") is-invalid @enderror"
          value="{{ old('mercado_exportacion') ? old('mercado_exportacion')[$key] : $producto->pivot->mercado_exportacion }}"
        />
        <div class="form-text">Mercados de importación / exportación</div>
        @error("mercado_exportacion.$key")
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>
    </div>
  @endforeach
</div>
<div class="mb-3 mb-3">
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
      <option
        {{ in_array($materia_prima->id, old('materias_primas', $afiliado->materias_primas ? $afiliado->materias_primas->pluck(['id'])->all() : [])) ? 'selected' : '' }}
        value="{{ $materia_prima->id }}"
      >{{ $materia_prima->materia_prima }}</option>
    @endforeach
  </select>
  @error('materias_primas')
    <div class="invalid-feedback">{{ $message }}</div>
  @enderror
</div>

<div class="mb-3">
  <label for="servicios" class="form-label">Servicios prestados</label>
  <select
    multiple
    class="form-select w-100 @error('servicios') is-invalid @enderror"
    name="servicios[]"
    id="servicios"
    data-placeholder="Seleccione uno o varios servicios"
  >
    <option></option>
    @foreach ($servicios as $servicio)
      <option
        {{ in_array($servicio->id, old('servicios', $afiliado->servicios ? $afiliado->servicios->pluck(['id'])->all() : [])) ? 'selected' : '' }}
        value="{{ $servicio->id }}"
      >{{ $servicio->nombre_servicio }}</option>
    @endforeach
  </select>
  @error('servicios')
    <div class="invalid-feedback">{{ $message }}</div>
  @enderror
</div>
<div class="mb-3">
  <label for="afiliados" class="form-label">Empresas asociadas a AVIPLA que la refieren</label>
  <select
    multiple
    class="form-select w-100 @error('afiliados') is-invalid @enderror"
    name="afiliados[]"
    id="afiliados"
    data-placeholder="Seleccione uno o varios afiliados"
  >
    <option></option>
    @foreach ($afiliados as $referencia)
      <option
        {{ in_array($referencia->id, old('afiliados', $afiliado->referencias ? $afiliado->referencias->pluck(['id'])->all() : [])) ? 'selected' : '' }}
        value="{{ $referencia->id }}">
        {{ $referencia->razon_social }}
      </option>
    @endforeach
  </select>
  @error('afiliados')
    <div class="invalid-feedback">{{ $message }}</div>
  @enderror
</div>