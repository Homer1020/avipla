@can('view', $avisoCobro)
  <button
    onclick="openModal({{ $avisoCobro->id }}, '{{ route('modal.avisoCobro', $avisoCobro) }}')"
    class="btn btn-success"
  >
    <i class="fa fa-eye"></i>
    Detalles
</button>
@endcan
@if ($avisoCobro->invoice)
  @can('view', $avisoCobro->invoice)
    <a target="_blank" href="{{ route('files.getFile', ['dir' => 'invoices', 'path' => $avisoCobro->invoice->invoice_path]) }}" class="btn btn-primary">
      <i class="fa fa-file-invoice"></i>
      Ver factura
    </a>
  @endcan
@endif