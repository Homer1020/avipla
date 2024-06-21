<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
    <div class="sb-sidenav-menu">
        <div class="nav">
            <div class="sb-sidenav-menu-heading">Core</div>
            <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                Dashboard
            </a>
            <div class="sb-sidenav-menu-heading">{{ Auth::user()->roles->first()->name }}</div>
           
            @can('viewAny', App\Models\Afiliado::class)
                <a class="nav-link {{ request()->routeIs('afiliados.*') ? 'active' : '' }}"
                    href="{{ route('afiliados.index') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-handshake"></i></div>
                    Afiliados
                </a>
            @endcan
            @can('viewAny', App\Models\Invoice::class)
                <a class="nav-link {{ request()->routeIs('invoices.*') ? 'active' : '' }}"
                    href="{{ route('invoices.index') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-file-invoice"></i></div>
                    Facturación
                </a>
            @endcan
            @can('viewAny', App\Models\Pago::class)
                <a class="nav-link {{ request()->routeIs('pagos.*') ? 'active' : '' }}" href="{{ route('pagos.index') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-credit-card"></i></div>
                    Estado de cuenta
                </a>
            @endcan
            @if (request()->user()->is_admin())
                <a
                    class="
                        nav-link
                        {{
                            request()->routeIs('noticias.*') || request()->routeIs('categories.*')
                            ? ''
                            : 'collapsed'
                        }}
                    "
                    href="#"
                    data-bs-toggle="collapse"
                    data-bs-target="#newsPage"
                    aria-expanded="false"
                    aria-controls="newsPage"
                >
                    <div class="sb-nav-link-icon"><i class="fas fa-newspaper"></i></div>
                    Noticias
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div
                    class="
                        collapse
                        {{
                            (request()->routeIs('noticias.*') || request()->routeIs('categories.*'))
                            ? 'show'
                            : ''
                        }}
                    "
                    id="newsPage"
                    aria-labelledby="headingTwo"
                    data-bs-parent="#sidenavAccordion"
                >
                    <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                        <a href="{{ route('noticias.index') }}" class="nav-link {{ request()->routeIs('noticias.*') ? 'active' : '' }}">Todas las noticias</a>
                        <a href="{{ route('categories.index') }}" class="nav-link {{ request()->routeIs('categories.*') ? 'active' : '' }}">Categorías</a>
                    </nav>
                </div>            
            @endif
            @if (request()->user()->is_admin())
                <a
                    class="
                        nav-link
                        {{
                            request()->routeIs('users.*') || request()->routeIs('roles.*')
                            ? ''
                            : 'collapsed'
                        }}
                    "
                    href="#"
                    data-bs-toggle="collapse"
                    data-bs-target="#usersPage"
                    aria-expanded="false"
                    aria-controls="usersPage"
                >
                    <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                    Usuarios
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div
                    class="
                        collapse
                        {{
                            (request()->routeIs('users.*') || request()->routeIs('roles.*'))
                            ? 'show'
                            : ''
                        }}
                    "
                    id="usersPage"
                    aria-labelledby="headingTwo"
                    data-bs-parent="#sidenavAccordion"
                >
                    <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                        <a href="{{ route('users.index') }}" class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}">Todos los usuarios</a>
                        <a href="{{ route('roles.index') }}" class="nav-link {{ request()->routeIs('roles.*') ? 'active' : '' }}">Roles</a>
                    </nav>
                </div>
            @endif
            <a class="nav-link {{ request()->routeIs('boletines.*') ? 'active' : '' }}" href="{{ route('boletines.index') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-envelope"></i></div>
                Boletines
            </a>
        </div>
    </div>
    <div class="sb-sidenav-footer">
        <div class="small">Logueado como:</div>
        {{ Auth::user()->name }}
    </div>
</nav>