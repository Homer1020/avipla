<div class="row mb-3">
  <div class="col-lg-6">
    <label for="razon_social" class="form-label">Razón social</label>
    <input
      type="text"
      class="form-control @error('razon_social') is-invalid @enderror"
      name="razon_social"
      id="razon_social"
      placeholder="Empresas Polar"
      value="{{ old('razon_social', $afiliado->razon_social) }}"
    >
    @error('razon_social')
      <span class="invalid-feedback">{{ $message }}</span>
    @enderror
  </div>
  <div class="col-lg-6">
    <label for="rif" class="form-label">RIF</label>
    <input
      type="text"
      class="form-control @error('rif') is-invalid @enderror"
      name="rif"
      id="rif"
      placeholder="J-000000001"
      value="{{ old('rif', $afiliado->rif) }}"
    >
    @error('rif')
      <span class="invalid-feedback">{{ $message }}</span>
    @enderror
  </div>
</div>

<div class="mb-3">
  <label for="correo" class="form-label">Correo electronico</label>
  <input
    type="text"
    class="form-control @error('correo') is-invalid @enderror"
    name="correo"
    id="correo"
    value="{{ old('correo', $afiliado->correo) }}"
    placeholder="johndoe@miempresa.com"
  >
  @error('correo')
    <span class="invalid-feedback">{{ $message }}</span>
  @enderror
</div>

<div class="mb-3">
  <label for="telefono" class="form-label">Teléfono</label>
  <input
    type="text"
    class="form-control @error('telefono') is-invalid @enderror"
    name="telefono"
    id="telefono"
    value="{{ old('telefono', $afiliado->telefono) }}"
    placeholder="+58 123 12 12"
  >
  @error('telefono')
    <span class="invalid-feedback">{{ $message }}</span>
  @enderror
</div>

<div class="mb-3">
  <label for="pagina_web" class="form-label">Pagina web</label>
  <input
    type="text"
    class="form-control @error('pagina_web') is-invalid @enderror"
    name="pagina_web"
    id="pagina_web"
    value="{{ old('pagina_web', $afiliado->pagina_web) }}"
  >
  @error('pagina_web')
    <span class="invalid-feedback">{{ $message }}</span>
  @enderror
</div>

<div class="mb-3">
  <label for="direccion" class="form-label">Dirección</label>
  <textarea
    name="direccion"
    id="direccion"
    rows="3"
    class="form-control @error('direccion') is-invalid @enderror"
  >{{ old('direccion', $afiliado->direccion) }}</textarea>
  @error('direccion')
    <span class="invalid-feedback">{{ $message }}</span>
  @enderror
</div>