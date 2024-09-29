@can('view', $avisoCobro)
  <button
    onclick="openModal({{ $avisoCobro->id }}, '{{ route('modal.avisoCobro', $avisoCobro) }}')"
    class="btn btn-success"
  >
    <i class="fa fa-eye"></i>
    Detalles
  </button>

  @can('delete', $avisoCobro)
    <form
      onsubmit="handleSubmitForm(event.target, 'DELETE', function() {
        invoicesTable.ajax.reload(null, false)
      }); return false;"
      method="POST"
      action="{{ route('avisos-cobro.destroy', $avisoCobro) }}"
      class="d-inline-block"
    >
      @csrf
      @method('DELETE')
      <button type="submit" class="btn btn-danger">
        <i class="fa fa-trash"></i>
        Eliminar
      </button>
    </form>
  @endcan
@endcan