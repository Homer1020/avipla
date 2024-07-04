@extends('layouts.dashboard')
@section('title', 'Datos del sitio web')
@section('content')
<h1 class="mt-4">Datos del sitio web</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Datos del sitio web</li>
</ol>
<div class="card mb-4">
    <div class="card-body">
        <h2 class="fs-5 mb-3">Carousel principal</h2>
        <form id="carousel-form" action="{{ route('carousel.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="titulo" name="titulo" class="form-label">Título <span class="text-danger fw-bold">*</span></label>
                        <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Título de la imágen">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="imagen" name="imagen" class="form-label">Imágen <span class="text-danger fw-bold">*</span></label>
                        <input class="form-control" type="file" name="imagen" id="imagen" accept="image/*">
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">
                <i class="fa fa-upload"></i>
                Subir imágen
            </button>
        </form>
    </div>
</div>
@endsection
@push('script')
    <script>
        $('#carousel-form').on('submit', function(event) {
            event.preventDefault()

            const fd = new FormData(event.target);

            fetch(event.target.action, {
                method: 'POST',
                body: fd
            })
            .then(response => response.json())
            .then(response => {
                const { data, success } = response
                if(!success) {
                    <!-- RESET VALIDATIONS -->
                    $('#carousel-form input').each(function() {
                        $(this).parent().find('.invalid-feedback').remove()
                        $(this).removeClass('is-invalid')
                    })

                    <!-- PRINT ERRORS -->
                    for (const name in data) {
                        const $input = $(`#carousel-form [name="${name}"]`)
                        $input.addClass('is-invalid')
                        $input.parent().append(`<span class="invalid-feedback">${ data[name][0] }</span>`)
                    }
                } else {
                    console.log(data)
                }
            })
        })
    </script>
@endpush