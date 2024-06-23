<a
    class="
        nav-link
        {{
            $active
            ? ''
            : 'collapsed'
        }}
    "
    href="#"
    data-bs-toggle="collapse"
    data-bs-target="#{{ $target }}"
    aria-expanded="false"
    aria-controls="{{ $target }}"
>
    <div class="sb-nav-link-icon"><i class="{{ $icon }}"></i></div>
    {{ $title }}
    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
</a>
<div
    class="
        collapse
        {{
            $active
            ? 'show'
            : ''
        }}
    "
    id="{{ $target }}"
    aria-labelledby="headingTwo"
    data-bs-parent="#sidenavAccordion"
>
    <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
        {{ $slot }}
    </nav>
</div>