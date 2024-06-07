@extends('layouts.dashboard')
@section('title', 'Facturas')
@section('content')
  <h1 class="mt-4">Facturas</h1>
  <ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Facturas</li>
  </ol>
  <div class="mb-4">
    <a href="{{ route('invoices.create') }}" class="btn btn-primary">Generar factura</a>
  </div>

  <table class="table table-bordered">
    <thead>
      <tr>
        <th>ID</th>
        <th>Fecha</th>
        <th>Concepto</th>
        <th>Empresa</th>
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
          <td>{{ $invoice->concepto }}</td>
          <td>
            <span class="text-truncate d-inline-block" style="max-width: 150px">
              {{ $invoice->afiliado->razon_social }}
            </span>
          </td>
          <td>
            <div class="badge bg-warning">
              {{ $invoice->estado }}
            </div>
          </td>
          <td>{{ $invoice->monto_total }}$</td>
          <td>
            <a class="btn btn-primary" href="{{ route('invoices.show', $invoice) }}">
              <i class="fa fa-eye"></i>
              Detalles
            </a>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
@endsection

@push('script')
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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

  </script>
@endpush