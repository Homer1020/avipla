<div class="card mb-3 shadow shadow-sm">
    <div class="card-body">
        <a href="{{ route('pagos.invoice', $notification->data['invoice_id']) }}" class="d-flex" style="text-decoration: none; color: #000;">
        <div class="flex-shrink-0">
            <div style="width: 45px; height: 45px;" class="rounded bg-info text-white d-flex align-items-center justify-content-center">
                <i class="fa fa-file-invoice fa-xl"></i>
            </div>
        </div>
        <div class="flex-grow-1 ms-3">
            <p class="m-0">
                Tienes una factura pendiente #{{ $notification->data['numero_factura'] }}.
            </p>
            <small>{{ $notification->created_at->diffForHumans() }}</small>
        </div>
        </a>
    </div>
</div>