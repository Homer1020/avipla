<p class="fw-bold text-uppercase text-muted">Productos</p>
<div class="mb-3">
  <label for="productos" class="form-label">Productos</label>
  <select
    multiple
    class="form-select w-100 @error('productos[]') is-invalid @enderror"
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
<div id="products_details">
  
</div>