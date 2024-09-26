@if ($avisoCobro->pago && $avisoCobro->estado === 'DEVUELTO')
  <a href="{{ route('pagos.edit', $avisoCobro->pago) }}" type="submit" class="btn btn-warning">
    <i class="fas fa-file-invoice"></i>
    Modificar Pago
  </a>
@endif
@if (!$avisoCobro->pago)
  <a href="{{ route('avisos-cobro.payCollectionNotice', $avisoCobro) }}" type="submit" class="btn btn-primary">
    <i class="fas fa-file-invoice"></i>
    Adjuntar pago
  </a>
@endif
<button
  onclick="openModal({{ $avisoCobro->id }}, '{{ route('modal.avisoCobro', $avisoCobro) }}')"
  class="btn btn-success"
>
    <i class="fa fa-eye"></i>
  Detalles
</button>