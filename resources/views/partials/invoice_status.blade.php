@switch($avisoCobro->estado)
    @case('CONCILIADO')
    <div class="badge bg-success" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $avisoCobro->observaciones }}">
        {{ $avisoCobro->estado }}
    </div>
    @break
    @case('PENDIENTE')
    <div class="badge bg-warning" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $avisoCobro->observaciones }}">
        {{ $avisoCobro->estado }}
    </div>
    @break
    @case('DEVUELTO')
    <div class="badge bg-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $avisoCobro->observaciones }}">
        {{ $avisoCobro->estado }}
        <i class="fa fa-info-circle"></i>
    </div>
    @break
    @default
    <div class="badge bg-secondary" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $avisoCobro->observaciones }}">
        {{ $avisoCobro->estado }}
    </div>
@endswitch