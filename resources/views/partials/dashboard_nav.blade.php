<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
    <div class="sb-sidenav-menu">
        <div class="nav">
            <div class="sb-sidenav-menu-heading">Core</div>
            <x-nav-link
                :to="route('dashboard')"
                active="dashboard"
                icon="fas fa-tachometer-alt"
            >
                Dashboard
            </x-nav-link>
            @if (Auth::user()->afiliado)
                <x-nav-link
                    :to="route('business.show')"
                    active="business.*"
                    icon="fas fa-building"
                >
                    Mi empresa
                </x-nav-link>
            @endif
            <x-nav-link
                :to="route('notifications.index')"
                active="notifications.*"
                icon="fas fa-bell"
            >
                Notificaciones
                @if(Auth::user()->unreadNotifications()->count() > 0)
                    <span class="badge bg-danger ms-auto">
                        {{ Auth::user()->unreadNotifications()->count() }}
                    </span>
                @endif
            </x-nav-link>
            <div class="sb-sidenav-menu-heading">{{ Auth::user()->roles->first()->name }}</div>
            @can('view_solicitud')
                <x-nav-link
                    :to="route('solicitudes.index')"
                    active="solicitudes.*"
                    icon="fas fa-user-plus"
                >
                    Solicitudes
                </x-nav-link>
            @endcan
            @can('view_afiliado')
                <x-nav-link
                    :to="route('afiliados.index')"
                    active="afiliados.*"
                    icon="fas fa-handshake"
                >
                    Afiliados
                </x-nav-link>
            @endcan
            @can('viewAny', App\Models\AvisoCobro::class)
                <x-nav-link
                    :to="route('avisos-cobro.index')"
                    active="avisos-cobro.*"
                    icon="fas fa-money-bill-wave"
                >
                    Avisos de cobro
                </x-nav-link>
            @endcan
            @can('view_factura')
                <x-nav-link
                    :to="route('invoices.index')"
                    active="invoices.*"
                    icon="fas fa-file-invoice"
                >
                    Facturas
                </x-nav-link>
            @endcan
            @can('view_noticia')
                <x-nav-link-dropdown
                    title="Noticias"
                    icon="fas fa-newspaper"
                    target="newsPage"
                    :active="request()->routeIs('noticias.*') || request()->routeIs('categories.*') || request()->routeIs('tags.*')"
                >
                    <a href="{{ route('noticias.index') }}" class="nav-link {{ request()->routeIs('noticias.*')  ? 'active' : '' }}">Todas las noticias</a>
                    @can('view_category')
                        <a href="{{ route('categories.index') }}" class="nav-link {{ request()->routeIs('categories.*') ? 'active' : '' }}">Categorías</a>
                    @endcan
                    @can('view_tag')
                        <a href="{{ route('tags.index') }}" class="nav-link {{ request()->routeIs('tags.*') ? 'active' : '' }}">Etiquetas</a>
                    @endcan
                </x-nav-link-dropdown>
            @endcan
            @can('viewAny', App\Models\Boletine::class)
                <x-nav-link-dropdown
                    title="Boletines"
                    icon="fas fa-envelope"
                    target="boletinesPage"
                    :active="request()->routeIs('boletines.*') || request()->routeIs('categorias-boletines.*')"
                >
                    <a href="{{ route('boletines.index') }}" class="nav-link {{ request()->routeIs('boletines.*') ? 'active' : '' }}">Todos los boletines</a>
                    @can('view_category_boletine')
                        <a href="{{ route('categorias-boletines.index') }}" class="nav-link {{ request()->routeIs('categorias-boletines.*') ? 'active' : '' }}">Categorías</a>
                    @endcan
                </x-nav-link-dropdown>
            @endcan
            @can('view_role')
                <x-nav-link-dropdown
                    title="Administrador"
                    icon="fas fa-shield-alt"
                    target="adminPages"
                    :active="
                        request()->routeIs('audits.*')
                        || request()->routeIs('database.*')
                        || request()->routeIs('users.*')
                        || request()->routeIs('roles.*')
                    "
                >
                    <a
                        href="{{ route('audits.index') }}"
                        class="nav-link {{ request()->routeIs('audits.*') ? 'active' : '' }}"
                    >
                        Auditorías
                    </a>
                    <a
                        href="{{ route('users.index') }}"
                        class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}"
                    >
                        Usuarios
                    </a>
                    <a
                        href="{{ route('roles.index') }}"
                        class="nav-link {{ request()->routeIs('roles.*') ? 'active' : '' }}"
                    >
                        Roles
                    </a>
                    <a
                        href="{{ route('database.index') }}"
                        class="nav-link {{ request()->routeIs('database.*') ? 'active' : '' }}"
                    >
                        Base de datos
                    </a>
                </x-nav-link-dropdown>
                <x-nav-link
                    :to="route('website.index')"
                    active="website.*"
                    icon="fas fa-database"
                >
                    Sitio web
                </x-nav-link>
            @endcan
        </div>
    </div>
    <div class="sb-sidenav-footer">
        <div class="small">Logueado como:</div>
        {{ Auth::user()->name }}
    </div>
</nav>