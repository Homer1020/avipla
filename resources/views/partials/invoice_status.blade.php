@switch($invoice->estado)
    @case('COMPLETADO')
    <div class="badge bg-success" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $invoice->observaciones }}">
        {{ $invoice->estado }}
    </div>
    @break
    @case('PENDIENTE')
    <div class="badge bg-warning" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $invoice->observaciones }}">
        {{ $invoice->estado }}
    </div>
    @break
    @case('CANCELADO')
    <div class="badge bg-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $invoice->observaciones }}">
        {{ $invoice->estado }}
        <i class="fa fa-info-circle"></i>
    </div>
    @break
    @default
    <div class="badge bg-secondary" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $invoice->observaciones }}">
        {{ $invoice->estado }}
    </div>
@endswitch