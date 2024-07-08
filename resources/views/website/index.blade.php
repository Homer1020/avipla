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
        <!-- Modal -->
        <div class="modal fade" id="editCarousel" tabindex="-1" aria-labelledby="editCarouselLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form id="carousel-edit-form" class="modal-content" method="POST" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="editCarouselLabel">Editar imágen</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="titulo" class="form-label">Título <span class="text-danger fw-bold">*</span></label>
                            <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Título de la imágen">
                        </div>
                        <div class="mb-3">
                            <label for="imagen" class="form-label">Imágen</label>
                            <input class="form-control" type="file" name="imagen" id="imagen" accept="image/*">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button id="saveCarousel" type="submit" class="btn btn-primary">Guardar cambios</button>
                    </div>
                </form>
            </div>
        </div>
        <form id="carousel-form" action="{{ route('carousel.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="titulo_edit" class="form-label">Título <span class="text-danger fw-bold">*</span></label>
                        <input type="text" class="form-control" id="titulo_edit" name="titulo" placeholder="Título de la imágen">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="imagen_edit" class="form-label">Imágen <span class="text-danger fw-bold">*</span></label>
                        <input class="form-control" type="file" name="imagen" id="imagen_edit" accept="image/*">
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">
                <i class="fa fa-upload"></i>
                Subir imágen
            </button>
        </form>

        <div id="display_images" class="row mt-3">
            @foreach ($carousels as $carousel)
                <div class="col-md-6 col-xl-3 mb-4" data-carousel="{{ $carousel->id }}" data-titulo="{{ $carousel->titulo }}" data-imagen="{{ $carousel->imagen }}">
                    <div class="position-relative">
                        <div class="ratio ratio-4x3">
                            <img class="w-100 rounded d-block" src="{{ Storage::url($carousel->imagen) }}" alt="{{ $carousel->titulo }}" style="object-fit: cover;" />
                        </div>
                        <div class="" style="position: absolute; top: 1rem; right: 1rem;">
                            <button class="btn btn-danger" onclick="handleDeleteCarouselImage({{ $carousel->id }})">
                                <i class="fa fa-trash"></i>
                            </button>
                            <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editCarousel">
                                <i class="fa fa-edit"></i>
                            </button>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mt-2 pb-3">
                        <p class="m-0 fw-bold text-truncate">{{ $carousel->titulo }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<div class="card mb-4">
    <div class="card-body">
        <h2 class="fs-5 mb-3">Redes sociales</h2>
        <form novalidate id="social-network-form" action="{{ route('social-networks.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-lg-6">
                    <label for="facebook" class="form-label">Facebook</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text">
                            <i class="fab fa-facebook"></i>
                        </span>
                        <input type="url" class="form-control" name="facebook" id="facebook" placeholder="Ingrese su perfil de Facebook" value="{{ $socialNetworks->facebook }}">
                    </div>
                </div>
                <div class="col-lg-6">
                    <label for="twitter" class="form-label">Twitter</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text">
                            <i class="fab fa-twitter"></i>
                        </span>
                        <input type="url" class="form-control" name="twitter" id="twitter" placeholder="Ingrese su perfil de Twitter" value="{{ $socialNetworks->twitter }}">
                    </div>  
                </div>
                <div class="col-lg-6">
                    <label for="instagram" class="form-label">Instagram</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text">
                            <i class="fab fa-instagram"></i>
                        </span>
                        <input type="url" class="form-control" name="instagram" id="instagram" placeholder="Ingrese su perfil de Instagram" value="{{ $socialNetworks->instagram }}">
                    </div>   
                </div>
                <div class="col-lg-6">
                    <label for="youtube" class="form-label">Youtube</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text">
                            <i class="fab fa-youtube"></i>
                        </span>
                        <input type="url" class="form-control" name="youtube" id="youtube" placeholder="Ingrese su canal de Youtube" value="{{ $socialNetworks->youtube }}">
                    </div> 
                </div>
                <div class="col-lg-6">
                    <label for="tiktok" class="form-label">Tiktok</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text">
                            <i class="fab fa-tiktok"></i>
                        </span>
                        <input type="url" class="form-control" name="tiktok" id="tiktok" placeholder="Ingrese su perfil de Tiktok" value="{{ $socialNetworks->tiktok }}">
                    </div>  
                </div>
            </div>
            
            <button type="submit" class="btn btn-primary">
                <i class="fa fa-save"></i>
                Guardar
            </button>
        </form>
    </div>
</div>

<div class="card mb-4">
    <div class="card-body">
        <h2 class="fs-5 mb-3">Organismos y representaciones</h2>
        <!-- Modal -->
        <div class="modal fade" id="editOrganismo" tabindex="-1" aria-labelledby="editOrganismoLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form id="organismo-edit-form" class="modal-content" method="POST" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="editOrganismoLabel">Editar organismos y representaciones</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="razon_social" class="form-label">Título <span class="text-danger fw-bold">*</span></label>
                            <input type="text" class="form-control" id="razon_social" name="razon_social" placeholder="Título de la imágen">
                        </div>
                        <div class="mb-3">
                            <label for="logotipo" class="form-label">Imágen</label>
                            <input class="form-control" type="file" name="logotipo" id="logotipo" accept="image/*">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button id="saveCarousel" type="submit" class="btn btn-primary">Guardar cambios</button>
                    </div>
                </form>
            </div>
        </div>
        <form id="organismos-form" action="{{ route('organismos.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="razon_social_edit" class="form-label">Razón social <span class="text-danger fw-bold">*</span></label>
                        <input type="text" class="form-control" id="razon_social_edit" name="razon_social" placeholder="Razón social de la  empresa">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="logotipo_edit" class="form-label">Logotipo <span class="text-danger fw-bold">*</span></label>
                        <input class="form-control" type="file" name="logotipo" id="logotipo_edit" accept="image/*">
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">
                <i class="fa fa-plus"></i>
                Agragar Organismo
            </button>
        </form>

        <div id="display_organismos" class="row mt-3">
            @foreach ($organismos as $organismo)
                <div class="col-lg-3 mb-3" data-organismo="{{ $organismo->id }}" data-razon-social="{{ $organismo->razon_social }}">
                    <figure class="figure position-relative">
                        <img src="{{ Storage::url($organismo->logotipo) }}" class="figure-img img-fluid rounded" alt="{{ $organismo->razon_social }}">
                        <figcaption class="figure-caption text-end">{{ $organismo->razon_social }}</figcaption>
                        <div class="" style="position: absolute; top: 1rem; right: 1rem;">
                            <button class="btn btn-danger" onclick="handleDeleteOrganismo({{ $organismo->id }})">
                                <i class="fa fa-trash"></i>
                            </button>
                            <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editOrganismo">
                                <i class="fa fa-edit"></i>
                            </button>
                        </div>
                    </figure>
                </div>
            @endforeach
        </div>
    </div>
</div>

<div class="card mb-4">
    <div class="card-body">
        <h2 class="fs-5 mb-3">Junta directiva</h2>
        <div class="modal fade" id="editJunta" tabindex="-1" aria-labelledby="editJuntaLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form id="junta-edit-form" class="modal-content" method="POST" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="editJuntaLabel">Modal title</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="junta_directiva_role_id" class="form-label">Cargo <span class="text-danger fw-bold">*</span></label>
                            <select name="junta_directiva_role_id" id="junta_directiva_role_id" class="form-select">
                                <option selected disabled>Seleccionar cargo</option>
                                @foreach ($juntaDirectivaRoles as $role)
                                    <option value="{{ $role->id }}">{{ $role->display_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre y apellido</label>
                            <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Ingrese nombre y apellido">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button id="saveCarousel" type="submit" class="btn btn-primary">Guardar cambios</button>
                    </div>
                </form>
            </div>
        </div>
        <form id="junta-form" action="{{ route('junta-directiva.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="junta_directiva_role_id" class="form-label">Cargo <span class="text-danger fw-bold">*</span></label>
                        <select name="junta_directiva_role_id" id="junta_directiva_role_id" class="form-select">
                            <option selected disabled>Seleccionar cargo</option>
                            @foreach ($juntaDirectivaRoles as $role)
                                <option value="{{ $role->id }}">{{ $role->display_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre y apellido</label>
                        <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Ingrese nombre y apellido">
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">
                <i class="fa fa-plus"></i>
                Agregar persona
            </button>
        </form>

        <div id="display_junta" class="row mt-3">
            @foreach ($juntaDirectivas as $juntaDirectiva)
                <div class="col-lg-3 mb-4" data-junta="{{ $juntaDirectiva->id }}" data-role="{{ $juntaDirectiva->junta_directiva_role_id }}" data-nombre="{{ $juntaDirectiva->nombre }}">
                    <div class="card shadow">
                        <div class="card-body">
                            <h3 class="fs-6">{{ $juntaDirectiva->role->display_name }}</h3>
                            <p>{{ $juntaDirectiva->nombre }}</p>

                            <div>
                                <button class="btn btn-danger" onclick="handleDeleteJunta({{ $juntaDirectiva->id }})">
                                    <i class="fa fa-trash"></i>
                                </button>
                                <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editJunta">
                                    <i class="fa fa-edit"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
@push('script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                const { data, success, message } = response
                <!-- RESET VALIDATIONS -->
                $('#carousel-form input').each(function() {
                    $(this).parent().find('.invalid-feedback').remove()
                    $(this).removeClass('is-invalid')
                })
                if(!success) {
                    <!-- PRINT ERRORS -->
                    for (const name in data) {
                        const $input = $(`#carousel-form [name="${name}"]`)
                        $input.addClass('is-invalid')
                        $input.parent().append(`<span class="invalid-feedback">${ data[name][0] }</span>`)
                    }
                } else {
                    const { imagen, titulo, id } = data
                    path = imagen.replace('public', 'storage')
                    const $imagen = `
                        <div class="col-md-6 col-xl-3 mb-4" data-carousel="${ id }" data-titulo="${ titulo }" data-imagen="${ path }">
                            <div class="position-relative">
                                <div class="ratio ratio-4x3">
                                    <img class="w-100 rounded d-block" src="${ path }" alt="${ titulo }" style="object-fit: cover;" />
                                </div>
                                <div class="" style="position: absolute; top: 1rem; right: 1rem;">
                                    <button class="btn btn-danger" onclick="handleDeleteCarouselImage(${ id })">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                    <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editCarousel">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mt-2 pb-3">
                                <p class="m-0 fw-bold text-truncate">${ titulo }</p>
                            </div>
                        </div>
                    `.trim()
                    
                    $displayImages.append($imagen)
                    $("#carousel-form").get(0).reset()
                    Swal.fire({
                        icon: "success",
                        title: message
                    })
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
                const { success, message } = response
                if(success) {
                    $carousel.remove();
                    Swal.fire({
                        icon: "success",
                        title: message
                    })
                }
            })
            $carousel.find('.btn-danger').removeAttr('disabled', true)
        }

        const $editCarousel = $(document.getElementById('editCarousel'))
        $editCarousel.on('show.bs.modal', event => {
            const $button = $(event.relatedTarget)
            const $imagen = $button.parent().parent().parent()
            const id = $imagen.data('carousel')
            const titulo = $imagen.data('titulo')
            const imagen = $imagen.data('imagen')
            
            $editCarousel.find('form').attr('action', `/carousel/${ id }`)
            $editCarousel.find('[name="titulo"]').val(titulo)     
        })

        const $carouselEditForm = $('#carousel-edit-form')

        $carouselEditForm.on('submit', function(event) {
            event.preventDefault()
            const fd = new FormData(event.target)
            fd.append('_method', 'PUT')

            fetch(event.target.action, {
                method: 'POST',
                body: fd,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            })
            .then(r => r.json())
            .then(response => {
                const { success, data, message } = response

                if(success) {
                    const $carousel = $(`[data-carousel="${ data.id }"]`)
                    $carousel.data('titulo', data.titulo)
                    $carousel.data('imagen', data.imagen.replace('public', 'storage'))
                    $carousel.find('p').text(data.titulo)
                    $carousel.find('img').attr('src', data.imagen.replace('public', 'storage'))
                    $carousel.find('img').attr('alt', data.titulo)
                    $editCarousel.modal('hide')
                    Swal.fire({
                        icon: "success",
                        title: message
                    })
                }
            })
        })

        const $socialNetworkForm = $('#social-network-form')

        $socialNetworkForm.on('submit', function(event) {
            event.preventDefault()
            const fd = new FormData(event.target);

            $socialNetworkForm.find('[type="submit"]').attr('disabled', true)

            fetch(event.target.action, {
                method: 'POST',
                body: fd
            })
            .then(r => r.json())
            .then(response => {
                const { data, success, message } = response
                if(success) {
                    Swal.fire({
                        icon: "success",
                        title: message
                    })
                } else {
                    $socialNetworkForm.find('input').each(function() {
                        $(this).parent().find('.invalid-feedback').remove()
                        $(this).removeClass('is-invalid')
                    })
                    <!-- PRINT ERRORS -->
                    for (const name in data) {
                        const $input = $socialNetworkForm.find(`[name="${name}"]`)
                        $input.addClass('is-invalid')
                        $input.parent().append(`<span class="invalid-feedback">${ data[name][0] }</span>`)
                    }
                }
            })
            .finally(() => {
                $socialNetworkForm.find('[type="submit"]').removeAttr('disabled')
            })
        })

        /* Organismos y representaciones */
        const $organismosForm = $('#organismos-form')
        const $displayOrganismos = $('#display_organismos')
        $organismosForm.on('submit', function(event) {
            event.preventDefault()
            const fd = new FormData(event.target);

            $organismosForm.find('[type="submit"]').attr('disabled', true)

            fetch(event.target.action, {
                method: 'POST',
                body: fd
            })
            .then(response => response.json())
            .then(response => {
                const { data, success, message } = response
                <!-- RESET VALIDATIONS -->
                $organismosForm.find('input').each(function() {
                    $(this).parent().find('.invalid-feedback').remove()
                    $(this).removeClass('is-invalid')
                })
                if(!success) {
                    <!-- PRINT ERRORS -->
                    for (const name in data) {
                        const $input = $organismosForm.find(`[name="${name}"]`)
                        $input.addClass('is-invalid')
                        $input.parent().append(`<span class="invalid-feedback">${ data[name][0] }</span>`)
                    }
                } else {
                    const { logotipo, razon_social, id } = data
                    path = logotipo.replace('public', 'storage')
                    const $imagen = `
                        <div class="col-lg-3 mb-3" data-organismo="${ id }" data-razon-social="${ razon_social }">
                            <figure class="figure position-relative">
                                <img src="${ path }" class="figure-img img-fluid rounded" alt="${ razon_social }">
                                <figcaption class="figure-caption text-end">${ razon_social }</figcaption>
                                <div class="" style="position: absolute; top: 1rem; right: 1rem;">
                                    <button class="btn btn-danger" onclick="handleDeleteOrganismo(${ id })">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                    <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editOrganismo">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                </div>
                            </figure>
                        </div>
                    `.trim()
                    
                    $displayOrganismos.append($imagen)
                    $("#organismos-form").get(0).reset()
                    Swal.fire({
                        icon: "success",
                        title: message
                    })
                }

                $organismosForm.find('[type="submit"]').removeAttr('disabled')
            })
        })

        function handleDeleteOrganismo(id) {
            const $organismo = $(`[data-organismo="${ id }"]`)
            $organismo.find('.btn-danger').attr('disabled', true)

            fetch(`organismos/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            })
            .then(response => response.json())
            .then(response => {
                const { success, message } = response
                if(success) {
                    $organismo.remove();
                    Swal.fire({
                        icon: "success",
                        title: message
                    })
                }
            })
            $organismo.find('.btn-danger').removeAttr('disabled', true)
        }

        const $editOrganismo = $(document.getElementById('editOrganismo'))
        $editOrganismo.on('show.bs.modal', event => {
            const $button = $(event.relatedTarget)
            const $imagen = $button.parent().parent().parent()
            console.log($imagen)
            const id = $imagen.data('organismo')
            const razonSocial = $imagen.data('razonSocial')
            const logotipo = $imagen.data('logotipo')
            
            $editOrganismo.find('form').attr('action', `/organismos/${ id }`)
            $editOrganismo.find('[name="razon_social"]').val(razonSocial)
        })

        const $organismoEditForm = $('#organismo-edit-form')

        $organismoEditForm.on('submit', function(event) {
            event.preventDefault()
            const fd = new FormData(event.target)
            fd.append('_method', 'PUT')

            fetch(event.target.action, {
                method: 'POST',
                body: fd,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            })
            .then(r => r.json())
            .then(response => {
                const { success, data, message } = response

                if(success) {
                    const $organismo = $(`[data-organismo="${ data.id }"]`)
                    $organismo.data('razonSocial', data.razon_social)
                    $organismo.find('figcaption').text(data.razon_social)
                    $organismo.find('img').attr('src', data.logotipo.replace('public', 'storage'))
                    $organismo.find('img').attr('alt', data.razon_social)
                    $editOrganismo.modal('hide')
                    Swal.fire({
                        icon: "success",
                        title: message
                    })
                }
            })
        })

        const $juntaForm = $('#junta-form')
        const $displayJunta = $('#display_junta')

        $juntaForm.on('submit', function(event) {
            event.preventDefault()
            const fd = new FormData(event.target);

            $juntaForm.find('[type="submit"]').attr('disabled', true)

            fetch(event.target.action, {
                method: 'POST',
                body: fd
            })
            .then(response => response.json())
            .then(response => {
                const { data, success, message } = response
                <!-- RESET VALIDATIONS -->
                $juntaForm.find('input, select').each(function() {
                    $(this).parent().find('.invalid-feedback').remove()
                    $(this).removeClass('is-invalid')
                })
                if(!success) {
                    <!-- PRINT ERRORS -->
                    for (const name in data) {
                        const $input = $juntaForm.find(`[name="${name}"]`)
                        $input.addClass('is-invalid')
                        $input.parent().append(`<span class="invalid-feedback">${ data[name][0] }</span>`)
                    }
                } else {
                    const { nombre, junta_directiva_role_id, id } = data
                    const option = $("#junta_directiva_role_id option[value="+ junta_directiva_role_id +"]").text().trim();
                    const $juntaItem = `
                        <div class="col-lg-3 mb-4" data-junta="${ id }" data-role="${ junta_directiva_role_id }" data-nombre="${ nombre }">
                            <div class="card shadow">
                                <div class="card-body">
                                    <h3 class="fs-6">${ option }</h3>
                                    <p>${ nombre }</p>
                                    <div>
                                        <button class="btn btn-danger" onclick="handleDeleteJunta(${ id })">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                        <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editJunta">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `.trim()
                    
                    $displayJunta.append($juntaItem)
                    $juntaForm.get(0).reset()
                    Swal.fire({
                        icon: "success",
                        title: message
                    })
                }

                $juntaForm.find('[type="submit"]').removeAttr('disabled')
            })
        })

        function handleDeleteJunta(id) {
            console.log(id)
            const $junta = $(`[data-junta="${ id }"]`)
            console.log($junta)
            $junta.find('.btn-danger').attr('disabled', true)
            
            fetch(`junta-directiva/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            })
            .then(response => response.json())
            .then(response => {
                console.log(response)
                const { success, message } = response
                if(success) {
                    $junta.remove();
                    Swal.fire({
                        icon: "success",
                        title: message
                    })
                }
            })
            $junta.find('.btn-danger').removeAttr('disabled', true)
        }

        const $editJunta = $(document.getElementById('editJunta'))
        $editJunta.on('show.bs.modal', event => {
            const $button = $(event.relatedTarget)
            const $imagen = $button
                .parent()
                .parent()
                .parent()
                .parent()
            console.log($imagen)
            const id = $imagen.data('junta')
            const role = $imagen.data('role')
            const nombre = $imagen.data('nombre')

            $editJunta.find("#junta_directiva_role_id option[value="+ role +"]").attr('selected', true)
            $editJunta.find('[name="nombre"]').val(nombre)
            
            $editJunta.find('form').attr('action', `/junta-directiva/${ id }`)
        })

        const $juntaEditForm = $('#junta-edit-form')

        $juntaEditForm.on('submit', function(event) {
            event.preventDefault()
            const fd = new FormData(event.target)
            fd.append('_method', 'PUT')

            fetch(event.target.action, {
                method: 'POST',
                body: fd,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            })
            .then(r => r.json())
            .then(response => {
                const { success, data, message } = response

                if(success) {
                    const $junta = $(`[data-junta="${ data.id }"]`)

                    console.log(data)

                    $junta.find('h3').text(data.role.display_name)
                    $junta.find('p').text(data.nombre)
                    $junta.data('role', data.role.id)
                    $junta.data('nombre', data.nombre)

                    $editJunta.modal('hide')
                    Swal.fire({
                        icon: "success",
                        title: message
                    })
                }
            })
        })
    </script>
@endpush