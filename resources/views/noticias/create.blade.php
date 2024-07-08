@extends('layouts.dashboard')
@section('title', 'Crear Noticia')
@push('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
@endpush
@section('content')
<h1 class="mt-4">Crear Noticia</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('noticias.index') }}">Noticias</a></li>
    <li class="breadcrumb-item active">Crear Noticia</li>
</ol>

<form action="{{ route('noticias.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="row">
        <div class="col-lg-8">
            <div class="card mb-4">
                <div class="card-body">
                    <p class="text-uppercase fw-bold text-muted">Noticia</p>
                    <div class="mb-3">
                        <label for="titulo" class="form-label">Título</label>
                        <input
                            name="titulo"
                            type="text"
                            class="form-control @error('titulo') is-invalid @enderror"
                            id="titulo"
                            value="{{ old('titulo') }}"
                            placeholder="Título"
                        >
                        @error('titulo')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="contenido" class="form-label">Contenido</label>
                        <textarea
                            id="contenido"
                            name="contenido"
                        >{{ old('contenido') }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary me-2">
                        <i class="fas fa-file-alt"></i>
                        Publicar
                    </button>
                    <button type="submit" name="save_draft" value="save_draft" class="btn btn-outline-primary">
                        <i class="fas fa-file-edit"></i>
                        Guardar borrador
                    </button>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <p class="text-uppercase fw-bold text-muted">Otros datos</p>
                    <div class="mb-3">
                        <label for="categoria_id" class="form-label">Categoría</label>
                        <select
                            name="categoria_id"
                            id="categoria_id"
                            class="selectpicker w-100 @error('categoria_id') is-invalid @enderror"
                            data-placeholder="Seleccione una categoría"
                        >
                            <option></option>
                            @foreach ($categorias as $categoria)
                                <option
                                    @selected(intval(old('categoria_id')) === $categoria->id)
                                    value="{{ $categoria->id }}"
                                >{{ $categoria->display_name }}</option>
                            @endforeach
                        </select>
                        @error('categoria_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="tags" class="form-label">Etiquetas</label>
                        <select
                            name="tags[]"
                            id="tags"
                            class="selectpicker w-100 @error('tags') is-invalid @enderror"
                            data-placeholder="Seleccione una etiqueta"
                            multiple
                        >
                            <option></option>
                            @foreach ($etiquetas as $etiqueta)
                                <option
                                    value="{{ $etiqueta->id }}"
                                    @selected(in_array($etiqueta->id, old('tags', [])))
                                >{{ $etiqueta->display_name }}</option>
                            @endforeach
                        </select>
                        @error('tags')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="thumbnail" class="form-label">Imagen principal</label>
                        <input
                            accept="image/*"
                            type="file"
                            name="thumbnail"
                            id="thumbnail"
                            class="form-control @error('thumbnail') is-invalid @enderror"
                        >
                        @error('thumbnail')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
@push('script')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#categoria_id').select2({
                theme: 'bootstrap-5'
            })
            $('#tags').select2({
                theme: 'bootstrap-5',
            })
        })
        $('#contenido').summernote({
            placeholder: 'Ingrese su contenido',
            tabsize: 2,
            height: 300,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['codeview', 'help']]
            ]
        });
    </script>
@endpush