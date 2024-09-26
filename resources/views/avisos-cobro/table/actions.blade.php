@can('view', $avisoCobro)
  <button
    onclick="openModal({{ $avisoCobro->id }}, '{{ route('modal.avisoCobro', $avisoCobro) }}')"
    class="btn btn-success"
  >
    <i class="fa fa-eye"></i>
    Detalles
</button>
@endcan