<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Avipla - @yield('title')</title>
        <!-- FAVICON -->
        <link rel="shortcut icon" href="{{ asset('assets/img/logo.png') }}" type="image/png">
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
        @stack('css')
        <style>
            .sb-nav-link-icon {
                width: 18px;
                text-align: center;
            }
        </style>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="{{ route('dashboard') }}">
                <img src="{{ asset('assets/img/logowhite.png') }}" alt="Logo AVIPLA" width="50" class="me-2">
                Intranet
            </a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Buscar..." aria-label="Buscar..." aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                @php $notifications = Auth::user()->unreadNotifications @endphp
                <li class="nav-item dropdown">
                    <a class="nav-link" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">
                        <i class="fa fa-bell fa-fw"></i>
                        <div class="badge bg-danger">
                            {{ $notifications->count() }}
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <h6 class="dropdown-header text-uppercase">Notificaciones sin leer ({{ $notifications->count() }})</h6>
                        <li><hr class="dropdown-divider"></li>
                        @forelse ($notifications as $notification)
                            @php
                                # Saber si el link de la notificacion debe dirigir a una vista de administrador o de afiliado
                                if(isset($notification->data['invoice_id'])) {
                                    $route = request()->user()->is_admin()
                                        ? route('avisos-cobro.show', $notification->data['invoice_id'])
                                        : route('pagos.invoice', $notification->data['invoice_id']);
                                } else if ($notification->data['boletine_slug']) {
                                    $route = route('boletines.show', $notification->data['boletine_slug']);
                                }

                                
                            @endphp
                            <li>
                                <a
                                    class="dropdown-item d-flex align-items-center"
                                    href="{{ $route }}"
                                >
                                    <div class="flex-shrink-0">
                                        <div style="width: 35px; height: 35px;" class="rounded bg text d-flex align-items-center justify-content-center">
                                            <i class="{{ $notification->data['icon'] }} fa-xl"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <p class="m-0">
                                        {{ $notification->data['message'] }}
                                        </p>
                                        <small>{{ $notification->created_at->diffForHumans() }}</small>
                                    </div>
                                </a>
                            </li>
                        @empty
                            <li>
                                <div class="p-3 py-1">
                                    <p class="m-0 text-muted d-flex align-items-center justify-content-center">
                                        <small>
                                            Sin novedades
                                        </small>
                                    </p>
                                </div>
                            </li>
                        @endforelse
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item text-center" href="{{ route('notifications.index') }}">Todas las notificaciones</a></li>
                    </ul>
                  </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li>
                            <a
                                class="dropdown-item {{ request()->routeIs('profile.show') ? 'active' : '' }}"
                                href="{{ route('profile.show') }}"
                            >Perfil de usuario</a>
                        </li>
                        <li><hr class="dropdown-divider" /></li>
                        <li>
                            <form action="{{ route('auth.logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item">Cerrar sesión</button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                @include('partials.dashboard_nav')
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        @yield('content')
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; avipla.com {{ date('Y') }}</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('js/scripts.js') }}"></script>
        @stack('script')
    </body>
</html>
