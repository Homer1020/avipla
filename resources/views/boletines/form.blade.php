<div class="mb-3">
    <label for="titulo" class="form-label">Título</label>
    <input
        name="titulo"
        type="text"
        class="form-control @error('titulo') is-invalid @enderror"
        id="titulo"
        value="{{ old('titulo', $boletine->titulo) }}"
        placeholder="Título"
    >
    @error('titulo')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>

<div class="mb-3">
    <label for="category_id" class="form-label">Categoría</label>
    <select
        name="category_id"
        id="category_id"
        class="selectpicker w-100 @error('category_id') is-invalid @enderror"
        data-placeholder="Seleccione una categoría"
    >
        <option></option>
        @foreach ($categorias as $categoria)
            <option
                @selected(intval(old('category_id', $boletine->category_id)) === $categoria->id)
                value="{{ $categoria->id }}"
            >{{ $categoria->display_name }}</option>
        @endforeach
    </select>
    @error('category_id')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="contenido" class="form-label">Contenido</label>
    <textarea
        id="contenido"
        name="contenido"
    >{{ old('contenido', $boletine->contenido) }}</textarea>
</div>