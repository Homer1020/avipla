@extends('layouts.dashboard')
@section('title', 'Estado de cuenta')
@push('css')
  <link rel="stylesheet" href="{{ asset('assets/css/datatables.min.css') }}">
@endpush
@section('content')
  <h1 class="mt-4">Estado de cuenta</h1>
  <ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Estado de cuenta</li>
  </ol>

  <div class="card mb-5">
    <div class="card-body">
      <table class="table table-bordered w-100" id="invoices-table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Código</th>
            <th>Referencia</th>
            <th>Fecha</th>
            <th>Estado</th>
            <th>Monto</th>
            <th>Tasa</th>
            <th>Acciones</th>
          </tr>
        </thead>
    
        <tbody>
          @foreach ($avisosCobros as $avisoCobro)
            <tr>
              <td>#{{ $avisoCobro->id }}</td>
              <td>#{{ $avisoCobro->codigo_aviso }}</td>
              <td>{{ $avisoCobro->pago ? '#' . $avisoCobro->pago->referencia : 'N/A' }}</td>
              <td>{{ $avisoCobro->created_at->format('d-m-Y') }}</td>
              <td> @include('partials.invoice_status') </td>
              <td>{{ $avisoCobro->pago ? $avisoCobro->pago->monto . '$' : 'N/A' }}</td>
              <td>{{ $avisoCobro->pago ? $avisoCobro->pago->tasa : 'N/A' }}</td>
              <td>
                @if ($avisoCobro->estado === 'DEVUELTO')
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
                <a class="btn btn-success" href="{{ route('pagos.invoice', $avisoCobro) }}">
                  <i class="fa fa-eye"></i>
                  Detalles
                </a>
                
                @if ($avisoCobro->invoice)
                  <a target="_blank" href="{{ route('files.getFile', ['dir' => 'invoices', 'path' => $avisoCobro->invoice->invoice_path]) }}" class="btn btn-primary">
                    <i class="fa fa-file-invoice"></i>
                    Ver factura
                  </a>
                @endif
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
@endsection

@push('script')
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="{{ asset('assets/css/datatables.min.js') }}"></script>

  @if (session('success'))
    <script>
        Swal.fire({
            icon: "success",
            title: "{{ session('success') }}"
        });
    </script>
  @endif

  <script>
    function submitAfterConfirm(form) {
      Swal.fire({
        title: "¿Estas seguro?",
        text: "¡Esta acción no se puede revertir!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, eliminalo!",
        cancelButtonText: "Cancelar"
      }).then((result) => {
        if (result.isConfirmed) form.submit()
      })
    }

    new DataTable('#invoices-table', {
      columnDefs: [
        { orderable: false, targets: 5 },
      ],
      order: false,
      scrollX: false,
      language: {
        // url: '//cdn.datatables.net/plug-ins/2.0.8/i18n/es-ES.json',
      }
    })

    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl)
    })

  </script>
@endpush