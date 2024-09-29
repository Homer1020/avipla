<div class="card mb-3 shadow shadow-sm">
    <div class="card-body">
        {{-- @php
            if(isset($notification->data['aviso_id'])) {
                $route = !request()->user()->roles()->where('name', 'afiliado')->exists()
                    ? route('avisos-cobro.show', $notification->data['invoice_id'])
                    : route('pagos.invoice', $notification->data['invoice_id']);
            } else if ($notification->data['boletine_slug']) {
                $route = route('boletines.show', $notification->data['boletine_slug']);
            }
        @endphp --}}
        <a href="{{ $notification->data['url'] }}" class="d-flex" style="text-decoration: none; color: #000;">
            <div class="flex-shrink-0">
                <div
                    style="width: 45px; height: 45px;"
                    class="rounded text-white d-flex align-items-center justify-content-center {{ $notification->data['bg-class'] }}"
                >
                    <i class="{{ $notification->data['icon'] }} fa-xl"></i>
                </div>
            </div>
            <div class="flex-grow-1 ms-3">
                <p class="m-0">
                    {{ $notification->data['message'] }}
                </p>
                <small>{{ $notification->created_at->diffForHumans() }} {{ request()->user()->is_admin() }}</small>
            </div>
        </a>
    </div>
</div>