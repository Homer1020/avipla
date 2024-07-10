@extends('layouts.main')
@section('title', 'Contacto')
@push('css')
    <style>
        .hero {
            height: 300px;
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            position: relative;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: linear-gradient(
                to bottom,
                rgba(50, 53, 103, .5),
                rgba(50, 53, 103, .9)
            );
        }

        .hero > * {
            position: relative;
            z-index: 1;
        }

        body {
            background-color: #f5f5f5;
        }

        #header .navbar-brand img {
            width: 90px;
        }

        .header-separator {
            height: 100px;
        }

        .icon {
            width: 65px;
            height: 65px;
            background-color: var(--color-secondary);
            border-radius: 5px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            margin-right: 15px;
        }

        .icon i {
            color: white;
            font-size: 24px;
        }

        .card-icon {
            display: flex;
            padding: 28px;
        }

        .form-control,
        .form-select {
            padding: 16px;
            font-size: 16px;
            border-radius: 0;
        }
    </style>
@endpush
@section('content')
<div class="header-separator"></div>
<div class="hero d-flex align-items-center" style="background-image: url(/assets/img/botellas3.jpg)">
    <div class="container">
        <h1 class="text-white text-uppercase fs-1 fw-bold">Contacto</h1>
    </div>
</div>
<div class="section">
    <div class="container-sm">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <h2 class="h4 text-uppercase fw-bold text-center mb-3">Dirección</h2>
                <p class="text-center mb-0">Avenida principal de Macaracuay, edificio Multicentro Macaracuay, piso 7, oficina 9.</p>
                <p class="text-center mb-5">Municipio Sucre - Caracas 1070</p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 mb-3">
                <div class="card shadow-sm h-100">
                    <div class="card-body card-icon">
                        <div class="icon">
                            <i class="fas fa-map"></i>
                        </div>
                        <div class="icon__content">
                            <h2 class="h5 fw-bold text-uppercase">Dirección</h2>
                            <p class="m-0">Multicentro Macaracuay</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mb-3">
                <div class="card shadow-sm h-100">
                    <div class="card-body card-icon">
                        <div class="icon">
                            <i class="fas fa-phone"></i>
                        </div>
                        <div class="icon__content">
                            <h2 class="h5 fw-bold text-uppercase">Teléfonos</h2>
                            <p class="m-0">(0212) 256 3345 / (0212) 256 3680</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mb-3">
                <div class="card shadow-sm h-100">
                    <div class="card-body card-icon">
                        <div class="icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="icon__content">
                            <h2 class="h5 fw-bold text-uppercase">Correo</h2>
                            <p class="m-0">infoavipla@avipla.online</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="section bg-white">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 mb-3 mb-lg-0">
                <h2 class="h4 text-uppercase fw-bold mb-4">Contáctanos</h2>
                <form action="">
                    <div class="row">
                        <div class="col-lg-6 mb-4">
                            <input type="text" name="nombre" placeholder="Tu nombre" class="form-control">
                        </div>
                        <div class="col-lg-6 mb-4">
                            <input type="text" name="apellido" placeholder="Tu apellido" class="form-control">
                        </div>
                        <div class="col-12 mb-4">
                            <input type="text" name="correo" placeholder="Tu correo electrónico" class="form-control">
                        </div>
                        <div class="col-12 mb-4">
                            <select name="" id="" class="form-select">
                                <option selected disabled>Seleccione el asunto</option>
                            </select>
                        </div>
                        <div class="col-12 mb-4">
                            <textarea name="mensaje" id="mensaje" rows="7" class="form-control" placeholder="Escribe tu mensaje"></textarea>
                        </div>
                    </div>
                    <butto class="btn btn-primary">
                        <i class="fa fa-paper-plane me-1"></i>
                        Enviar
                    </butto>
                </form>
            </div>
            <div class="col-lg-6">
                <iframe class="w-100 h-100 rounded" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d7846.8696256922285!2d-66.818301!3d10.466348!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8c2a581857faaa23%3A0x1e74f81bb9dd9b7e!2sMulticentro%20Macaracuay!5e0!3m2!1ses!2sve!4v1720580254825!5m2!1ses!2sve" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </div>
</section>
@endsection