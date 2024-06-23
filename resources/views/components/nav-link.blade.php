<a
    class="nav-link {{ request()->routeIs($active) ? 'active' : '' }}"
    href="{{ $to }}"
>
    <div class="sb-nav-link-icon"><i class="{{ $icon }}"></i></div>
    {{ $slot }}
</a>