<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AVIPLA | @yield('title')</title>
    <!-- BOOTSTRAP -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <!-- CUSTOM CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">
    <!-- OWL CAROUSEL -->
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">
    <!-- OWL CAROUSEL THEME -->
    <link rel="stylesheet" href="{{ asset('assets/css/owl.theme.default.css') }}">
</head>

<body>
    <!-- navbar -->
    <header id="header">
        <nav class="navbar py-0 navbar-expand-lg shadow-sm">
            <div class="container-md">
                <a class="navbar-brand" href="{{ route('home') }}">
                    <img src="{{ asset('assets/img/logo.png') }}" width="100" alt="Logo AVIPLA">
                </a>
                <div class="d-flex align-items-center">
                    <a href="#" class="btn btn-primary btn-variation me-4 text-uppercase">Afiliación</a>
    
                    <button class="toggle" id="toggle" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample"
                        aria-controls="offcanvasExample">
                        <div class="bars">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </button>
                </div>
            </div>
        </nav>
    </header>
    <!-- /navbar -->

    <!-- sidenav -->
    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-header">
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body p-5">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link"href="{{ route('home') }}">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('about') }}">¿Quienes somos?</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('services') }}">Servicios</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('affiliation') }}">Afiliacion</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('news') }}">Noticias</a>
                </li>
                <li class="nav-item mb-4">
                    <a class="nav-link" href="{{ route('contact') }}">Contacto</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('affiliation') }}" class="btn btn-primary btn-variation me-5 text-uppercase">Afiliación</a>
                </li>

                <div class="social-links">
                    <a href="#" class="social-link">
                        <i class="fab fa-xl fa-x-twitter"></i>
                    </a>
                    <a href="#" class="social-link">
                        <i class="fab fa-xl fa-instagram"></i>
                    </a>
                    <a href="#" class="social-link">
                        <i class="fab fa-xl fa-facebook"></i>
                    </a>
                    <a href="#" class="social-link">
                        <i class="fab fa-xl fa-youtube"></i>
                    </a>
                </div>
            </ul>
        </div>
    </div>
    <!-- /sidenav -->

    <main>
        @yield('content')
        <footer class="bg-secondary footer">
            <div class="container-sm">
                <div class="row justify-content-center">
                    <div class="offset-md-3 col-md-4">
                        <div class="text-center">
                            <img src="./assets/img/logowhite.png" alt="Logo" width="100">
                        </div>
                    </div>

                    <div class="col-md-3 mt-5 mt-md-0">
                        <address class="text-light text-center text-lg-start">
                            <small>
                                Multicentro Macaracuay Piso 7 - Oficina 709 Avenida Principal de Macaracuay Municipio Sucre - Caracas 1070. 
                            </small>
                        </address>
                    </div>
                    
                    <div class="col-12">
                        <div class="social-links d-flex justify-content-center">
                            <a href="#" class="social-link">
                                <i class="fab fa-xl fa-x-twitter"></i>
                            </a>
                            <a href="#" class="social-link">
                                <i class="fab fa-xl fa-instagram"></i>
                            </a>
                            <a href="#" class="social-link">
                                <i class="fab fa-xl fa-facebook"></i>
                            </a>
                            <a href="#" class="social-link">
                                <i class="fab fa-xl fa-youtube"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </main>

    <!-- BOOTSTRAP -->
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <!-- OWL CAROUSEL -->
    <script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
    <!-- SCRIPT -->
    <script src="{{ asset('assets/js/app.js') }}"></script>
</body>

</html>