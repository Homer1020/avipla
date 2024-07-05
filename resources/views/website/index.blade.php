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
            <button id="button_upload" type="submit" class="btn btn-primary">
                <i class="fa fa-upload"></i>
                Subir imágen
            </button>
        </form>

        <div id="display_images" class="row mt-3">
            @foreach ($carousels as $carousel)
                <div class="col-md-6 col-xl-3 mb-4" data-carousel="{{ $carousel->id }}">
                    <div class="ratio ratio-4x3">
                        <img class="w-100 rounded d-block" src="{{ Storage::url($carousel->imagen) }}" alt="{{ $carousel->titulo }}" style="object-fit: cover;" />
                    </div>
                    <div class="d-flex justify-content-between align-items-center mt-3 pb-3">
                        <p class="m-0 fw-bold">{{ $carousel->titulo }}</p>
                        <div class="">
                            <button class="btn btn-danger" onclick="handleDeleteCarouselImage({{ $carousel->id }})">
                                <i class="fa fa-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<div class="card mb-4">
    <div class="card-body">
        <h2 class="fs-5 mb-3">Redes sociales</h2>
    </div>
</div>

<div class="card mb-4">
    <div class="card-body">
        <h2 class="fs-5 mb-3">Junta directiva</h2>
    </div>
</div>
@endsection
@push('script')
    <script>
        $displayImages = $('#display_images')
        $buttonUpload = $('#button_upload')
        $('#carousel-form').on('submit', function(event) {
            event.preventDefault()
            const fd = new FormData(event.target);

            $buttonUpload.attr('disabled', true)

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
                    const { imagen, titulo } = data
                    path = imagen.replace('public', 'storage')
                    const $imagen = `
                        <div class="col-md-6 col-xl-3 mb-4">
                            <div class="ratio ratio-4x3">
                                <img class="w-100 rounded d-block" src="${ path }" alt="${ titulo }" style="object-fit: cover;" />
                            </div>
                            <div class="d-flex justify-content-between align-items-center mt-3 pb-3">
                                <p class="m-0 fw-bold">${ titulo }</p>
                                <div class="">
                                    <button class="btn btn-danger">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    `.trim()
                    $displayImages.append($imagen)
                    $("#carousel-form").get(0).reset()
                }

                $buttonUpload.removeAttr('disabled')
            })
        })

        function handleDeleteCarouselImage(id) {
            const $carousel = $(`[data-carousel="${ id }"]`)
            $carousel.find('.btn-danger').attr('disabled', true)

            fetch(`carousel/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            })
            .then(response => response.json())
            .then(response => {
                const { success } = response
                if(success) {
                    $carousel.remove();
                }
            })
            $carousel.find('.btn-danger').removeAttr('disabled', true)
        }
    </script>
@endpush