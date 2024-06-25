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
      <table class="table table-bordered" id="invoices-table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Fecha</th>
            <th>Estado</th>
            <th>Monto</th>
            <th>Acciones</th>
          </tr>
        </thead>
    
        <tbody>
          @foreach ($invoices as $invoice)
            <tr>
              <td>#{{ $invoice->id }}</td>
              <td>{{ $invoice->created_at }}</td>
              <td>
                @include('partials.invoice_status')
              </td>
              <td>{{ $invoice->monto_total }}$</td>
              <td>
                @if ($invoice->estado === 'CANCELADO')
                  @can('update', $invoice)
                    <a href="{{ route('pagos.update_pay', $invoice) }}" type="submit" class="btn btn-warning">
                      <i class="fas fa-file-invoice"></i>
                      Modificar Pago
                    </a>
                  @endcan
                @endif
                @if (!$invoice->pago)
                  @can('update', $invoice)
                    <a href="{{ route('pagos.pay_invoice', $invoice) }}" type="submit" class="btn btn-primary">
                      <i class="fas fa-file-invoice"></i>
                      Pagar factura
                    </a>
                  @endcan
                @endif
                @can('view', $invoice)
                  <a class="btn btn-success" href="{{ route('pagos.invoice', $invoice) }}">
                    <i class="fa fa-eye"></i>
                    Detalles
                  </a>
                @endcan
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
        { orderable: false, targets: 4 },
      ],
      order: false,
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