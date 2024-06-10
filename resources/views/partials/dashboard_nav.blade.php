<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
    <div class="sb-sidenav-menu">
        <div class="nav">
            <div class="sb-sidenav-menu-heading">Core</div>
            <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                Dashboard
            </a>
            <div class="sb-sidenav-menu-heading">Administrador</div>
            <a class="nav-link {{ request()->routeIs('afiliados.*') ? 'active' : '' }}"
                href="{{ route('afiliados.index') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-handshake"></i></div>
                Afiliados
            </a>
            <a class="nav-link {{ request()->routeIs('invoices.*') ? 'active' : '' }}"
                href="{{ route('invoices.index') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-file-invoice"></i></div>
                Facturación
            </a>
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
                data-bs-target="#collapsePages"
                aria-expanded="false"
                aria-controls="collapsePages"
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
                id="collapsePages"
                aria-labelledby="headingTwo"
                data-bs-parent="#sidenavAccordion"
            >
                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                    <a href="{{ route('noticias.index') }}" class="nav-link {{ request()->routeIs('noticias.*') ? 'active' : '' }}">Todas las noticias</a>
                    <a href="{{ route('categories.index') }}" class="nav-link {{ request()->routeIs('categories.*') ? 'active' : '' }}">Categorías</a>
                </nav>
            </div>
            <a class="nav-link" href="{{ route('notifications.index') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-envelope"></i></div>
                Boletines
            </a>
            {{-- <a class="nav-link" href="{{ route('notifications.index') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-briefcase"></i></div>
                Mi empresa
            </a>
            <a class="nav-link" href="{{ route('notifications.index') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-headset"></i></div>
                Contacto
            </a> --}}
        </div>
    </div>
    <div class="sb-sidenav-footer">
        <div class="small">Logueado como:</div>
        {{ Auth::user()->name }}
    </div>
</nav>