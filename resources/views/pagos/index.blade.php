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

  <div class="card">
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
                <div class="badge bg-warning">
                  {{ $invoice->estado }}
                </div>
              </td>
              <td>{{ $invoice->monto_total }}$</td>
              <td>
                @can('create', App\Models\Pago::class)
                    <form action="#" class="d-inline-block">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-file-invoice"></i>
                            Pagar factura
                        </button>
                    </form>
                @endcan
                @can('view', $invoice)
                  <a class="btn btn-success" href="{{ route('pagos.invoice', $invoice) }}">
                    <i class="fa fa-eye"></i>
                    Detalles
                  </a>
                  <a target="_blank" href="{{ route('files.getFile', ['dir' => 'invoices', 'path' => $invoice->documento]) }}" class="btn btn-outline-primary">
                    <i class="fa fa-file"></i>
                    Documento
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
  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
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

  </script>
@endpush