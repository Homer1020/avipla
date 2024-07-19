@extends('layouts.dashboard')
@section('title', 'Facturas')
@push('css')
  <link rel="stylesheet" href="{{ asset('assets/css/datatables.min.css') }}">
@endpush
@section('content')
  <h1 class="mt-4">Facturas</h1>
  <ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Facturas</li>
  </ol>
  @can('create', App\Models\Invoice::class)
    <div class="mb-4">
        <a href="{{ route('invoices.create') }}" class="btn btn-primary">Generar factura</a>
    </div>
  @endcan
  <div class="card">
    <div class="card-body">
      <table class="table table-bordered w-100" id="invoices-table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Factura N°</th>
            <th>Fecha</th>
            <th>Afiliado</th>
            <th>Monto</th>
            <th>Acciones</th>
          </tr>
        </thead>
    
        <tbody>
          @foreach ($invoices as $invoice)
            @can('view', $invoice)
                <tr>
                    <td>#{{ $invoice->id }}</td>
                    <td>#{{ $invoice->numero_factura }}</td>
                    <td>{{ $invoice->created_at->format('Y-m-d') }}</td>
                    <td>
                        <span class="text-truncate d-inline-block" style="max-width: 150px">
                        {{ $invoice->avisoCobro->afiliado->razon_social }}
                        </span>
                    </td>
                    <td>{{ $invoice->avisoCobro->pago->monto }}$ </td>
                    <td>
                        <a href="{{ route("invoices.show", $invoice) }}" class="btn btn-primary">
                          <i class="fa fa-file-invoice"></i>
                          Ver detalles
                      </a>
                    </td>
                </tr>
            @endcan
          @endforeach
        </tbody>
        @can('create', App\Models\Invoice::class)
          <tfoot>
            <tr>
              <th></th>
              <th></th>
              <th></th>
              <th></th>
              <th></th>
              <th></th>
            </tr>
          </tfoot>
        @endcan
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
        {
          orderable: false,
          targets: 5
        }
      ],
      order: false,
      scrollX: false,
      language: {
        // url: '//cdn.datatables.net/plug-ins/2.0.8/i18n/es-ES.json',
      },
      initComplete: function () {
        this.api()
            .columns([2,3])
            .every(function () {
                let column = this;
 
                // Create select element
                let select = document.createElement('select');
                select.classList.add('form-select');
                select.add(new Option('Remover filtro', ''));
                column.footer().replaceChildren(select);
 
                // Apply listener for user change in value
                select.addEventListener('change', function () {
                    column
                        .search(select.value, {exact: false})
                        .draw();
                });
 
                // Add list of options
                column
                    .data()
                    .unique()
                    .sort()
                    .each(function (d, j) {
                      text = d.replace(/<[^>]*>/g, '').trim();
                      select.add(new Option(text));
                    });
            });
      }
    })

    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl)
    })

  </script>
@endpush