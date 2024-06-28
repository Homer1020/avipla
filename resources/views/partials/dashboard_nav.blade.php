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
            @if (Auth::user()->roles->first()->name === 'afiliado')
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
                <span class="badge bg-danger ms-auto">
                    {{ Auth::user()->unreadNotifications()->count() }}
                </span>
            </x-nav-link>
            <div class="sb-sidenav-menu-heading">{{ Auth::user()->roles->first()->name }}</div>
            @can('viewAny', App\Models\Afiliado::class)
                <x-nav-link
                    :to="route('afiliados.index')"
                    active="afiliados.*"
                    icon="fas fa-handshake"
                >
                    Afiliados
                </x-nav-link>
            @endcan
            @can('viewAny', App\Models\Invoice::class)
                <x-nav-link
                    :to="route('invoices.index')"
                    active="invoices.*"
                    icon="fas fa-file-invoice"
                >
                    Facturación
                </x-nav-link>
            @endcan
            @can('viewAny', App\Models\Pago::class)
                <x-nav-link
                    :to="route('pagos.index')"
                    active="pagos.*"
                    icon="fas fa-credit-card"
                >
                    Estado de cuenta
                </x-nav-link>
            @endcan
            @if (request()->user()->is_admin())
                <x-nav-link-dropdown
                    title="Noticias"
                    icon="fas fa-newspaper"
                    target="newsPage"
                    :active="request()->routeIs('noticias.*') || request()->routeIs('categories.*') || request()->routeIs('tags.*')"
                >
                    <a href="{{ route('noticias.index') }}" class="nav-link {{ request()->routeIs('noticias.*')  ? 'active' : '' }}">Todas las noticias</a>
                    <a href="{{ route('categories.index') }}" class="nav-link {{ request()->routeIs('categories.*') ? 'active' : '' }}">Categorías</a>
                    <a href="{{ route('tags.index') }}" class="nav-link {{ request()->routeIs('tags.*') ? 'active' : '' }}">Etiquetas</a>
                </x-nav-link-dropdown>

                <x-nav-link-dropdown
                    title="Usuarios"
                    icon="fas fa-users"
                    target="usersPage"
                    :active="request()->routeIs('users.*') || request()->routeIs('roles.*')"
                >
                    <a href="{{ route('users.index') }}" class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}">Todos los usuarios</a>
                    <a href="{{ route('roles.index') }}" class="nav-link {{ request()->routeIs('roles.*') ? 'active' : '' }}">Roles</a>
                </x-nav-link-dropdown>
            @endif
            @if (Auth::user()->is_admin())
                <x-nav-link-dropdown
                    title="Boletines"
                    icon="fas fa-envelope"
                    target="boletinesPage"
                    :active="request()->routeIs('boletines.*') || request()->routeIs('categorias-boletines.*')"
                >
                    <a href="{{ route('boletines.index') }}" class="nav-link {{ request()->routeIs('boletines.*') ? 'active' : '' }}">Todos los boletines</a>
                    <a href="{{ route('categorias-boletines.index') }}" class="nav-link {{ request()->routeIs('categorias-boletines.*') ? 'active' : '' }}">Categorías</a>
                </x-nav-link-dropdown>
            @else
                <x-nav-link
                    :to="route('boletines.index')"
                    active="boletines.*"
                    icon="fas fa-envelope"
                >
                    Boletines
                </x-nav-link>
            @endif
            @if (Auth::user()->is_admin())
                <x-nav-link
                    :to="route('website.index')"
                    active="website.*"
                    icon="fas fa-database"
                >
                    Sitio web
                </x-nav-link>
            @endif
        </div>
    </div>
    <div class="sb-sidenav-footer">
        <div class="small">Logueado como:</div>
        {{ Auth::user()->name }}
    </div>
</nav>