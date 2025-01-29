<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AVIPLA | @yield('title')</title>
    <!-- METATAGS -->
    <meta name="description" content="@yield('meta_description', 'La Asociación Venezolana de Plástico promueve el desarrollo y la innovación en la industria del plástico en Venezuela.')">
    <meta name="keywords" content="@yield('meta_keywords', 'asociación, venezolana, plástico, industria, Venezuela, reciclaje, desarrollo, innovación')">
    <meta name="author" content="AVIPLA">
    <meta property="og:type" content="website">
    <!-- FAVICON -->
    <link rel="shortcut icon" href="{{ asset('assets/img/logo.png') }}" type="image/png">
    <!-- BOOTSTRAP -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <!-- CUSTOM CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">
    <!-- OWL CAROUSEL -->
    <link rel="stylesheet" href="{{ asset('assets/css/owl.carousel.min.css') }}">
    <!-- OWL CAROUSEL THEME -->
    <link rel="stylesheet" href="{{ asset('assets/css/owl.theme.default.css') }}">
    <!-- GOOGLE FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    @stack('css')
</head>

<body>
    <!-- navbar -->
    <header id="header">
        <nav class="navbar py-0 navbar-expand-lg shadow-sm">
            <div class="container-md">
                <a class="navbar-brand" href="{{ route('home') }}">
                    <img src="{{ asset('assets/img/logo.png') }}" alt="Logo AVIPLA">
                </a>
                <div class="d-flex align-items-center">
                    <a href="{{ route('affiliation') }}" class="d-none d-md-inline-block btn btn-primary btn-variation me-4 text-uppercase">Afiliación</a>
    
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
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('contact') }}">Contacto</a>
                </li>
                @auth
                    <li class="nav-item mb-4">
                        <a class="nav-link" href="{{ route('dashboard') }}">Intranet</a>
                    </li>
                @endauth
                <li class="nav-item">
                    <div class="d-flex justify-content-start align-items-center">
                        <a href="{{ route('affiliation') }}" class="btn btn-primary me-3 btn-variation text-uppercase">Afiliación</a>
                        <a href="{{ route('directory') }}">
                            <i class="fas fa-address-book fa-lg"></i>
                        </a>
                    </div>
                </li>

                <div class="social-links">
                    @if ($socialNetwork->twitter)
                        <a href="{{ $socialNetwork->twitter }}" target="_blank" class="social-link">
                            <i class="fab fa-xl fa-x-twitter"></i>
                        </a>
                    @endif
                    @if ($socialNetwork->instagram)
                        <a href="{{ $socialNetwork->instagram }}" target="_blank" class="social-link">
                            <i class="fab fa-xl fa-instagram"></i>
                        </a>
                    @endif
                    @if ($socialNetwork->facebook)
                        <a href="{{ $socialNetwork->facebook }}" target="_blank" class="social-link">
                            <i class="fab fa-xl fa-facebook"></i>
                        </a>
                    @endif
                    @if ($socialNetwork->youtube)
                        <a href="{{ $socialNetwork->youtube }}" target="_blank" class="social-link">
                            <i class="fab fa-xl fa-youtube"></i>
                        </a>
                    @endif
                    @if ($socialNetwork->linkedin)
                        <a href="{{ $socialNetwork->linkedin }}" target="_blank" class="social-link">
                            <i class="fab fa-xl fa-linkedin"></i>
                        </a>
                    @endif
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
                            <img src="/assets/img/logowhite.png" alt="Logo" width="100">
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
                            @if ($socialNetwork->twitter)
                                <a href="{{ $socialNetwork->twitter }}" class="social-link">
                                    <i class="fab fa-xl fa-x-twitter"></i>
                                </a>
                            @endif
                            @if ($socialNetwork->instagram)
                                <a href="{{ $socialNetwork->instagram }}" class="social-link">
                                    <i class="fab fa-xl fa-instagram"></i>
                                </a>
                            @endif
                            @if ($socialNetwork->facebook)
                                <a href="{{ $socialNetwork->facebook }}" class="social-link">
                                    <i class="fab fa-xl fa-facebook"></i>
                                </a>
                            @endif
                            @if ($socialNetwork->youtube)
                                <a href="{{ $socialNetwork->youtube }}" class="social-link">
                                    <i class="fab fa-xl fa-youtube"></i>
                                </a>
                            @endif
                            @if ($socialNetwork->linkedin)
                                <a href="{{ $socialNetwork->linkedin }}" class="social-link">
                                    <i class="fab fa-xl fa-linkedin"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </main>

    <!-- BOOTSTRAP -->
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <!-- SWEET ALERT -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <!-- OWL CAROUSEL -->
    <script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
    <!-- SCRIPT -->
    <script src="{{ asset('assets/js/app.js') }}"></script>
    @if (session('success'))
        <script>
            Swal.fire({
                icon: "success",
                text: "{{ session('success') }}",
                confirmButtonColor: "#323567",
            });
        </script>
    @endif
    @stack('script')
</body>

</html>