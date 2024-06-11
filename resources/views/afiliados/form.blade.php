<div class="row">
  <div class="col-lg-4">
    <x-forms.input
      name="razon_social"
      id="razon_social"
      placeholder="Empresas Polar"
      label="Razón social"
      :value="old('razon_social', $afiliado->razon_social)"
      :error="$errors->first('razon_social')"
    />
  </div>
  <div class="col-lg-4">
    <x-forms.input
      name="rif"
      id="rif"
      placeholder="J-000000001"
      label="RIF"
      :value="old('rif', $afiliado->rif)"
      :error="$errors->first('rif')"
    />
  </div>
  <div class="col-lg-4">
    <x-forms.input
      name="siglas"
      id="siglas"
      placeholder="AVIPLA"
      label="Siglas"
      :value="old('siglas', $afiliado->siglas)"
      :error="$errors->first('siglas')"
    />
  </div>
</div>

<div class="row">
  <div class="col-lg-6">
    <x-forms.input
      type="email"
      name="correo"
      id="correo"
      label="Correo electronico"
      placeholder="johndoe@miempresa.com"
      :value="old('correo', $afiliado->correo)"
      :error="$errors->first('correo')"
    />
  </div>
  <div class="col-lg-6">
    <x-forms.input
      type="text"
      class="form-control @error('telefono') is-invalid @enderror"
      name="telefono"
      id="telefono"
      label="Teléfono"
      :value="old('telefono', $afiliado->telefono)"
      placeholder="+58 123 12 12"
    />
  </div>
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