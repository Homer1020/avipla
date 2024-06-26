<div class="card mb-3 shadow shadow-sm">
    <div class="card-body">
        @php
            # Saber si el link de la notificacion debe dirigir a una vista de administrador o de afiliado
            $route = request()->user()->is_admin()
                ? route('invoices.show', $notification->data['invoice_id'])
                : route('pagos.invoice', $notification->data['invoice_id']);
        @endphp
        <a href="{{ $route }}" class="d-flex" style="text-decoration: none; color: #000;">
        <div class="flex-shrink-0">
            <div style="width: 45px; height: 45px;" class="rounded bg-info text-white d-flex align-items-center justify-content-center">
                <i class="fa fa-file-invoice fa-xl"></i>
            </div>
        </div>
        <div class="flex-grow-1 ms-3">
            <p class="m-0">
                {{ $notification->data['message'] }}
            </p>
            <small>{{ $notification->created_at->diffForHumans() }}</small>
        </div>
        </a>
    </div>
</div>