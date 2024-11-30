@extends('layouts.dashboard')
@section('title', 'Auditorías')
@push('css')
  <link rel="stylesheet" href="{{ asset('assets/css/datatables.min.css') }}">
@endpush
@section('content')
  <h1 class="mt-4 fs-4">
    <i class="fas fa-search fa-sm"></i>
    Auditorías
  </h1>
  <ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Auditorías</li>
  </ol>
  <div class="mb-4 card">
    <div class="card-body">
      <table class="table table-bordered w-100" id="audits-table">
        <thead>
          <tr>
            <th>Usuario</th>
            <th>Evento</th>
            <th>Módelo</th>
            <th>IP</th>
            <th>Fecha</th>
            {{-- <th>Acciones</th> --}}
          </tr>
        </thead>
        <tbody>
          @foreach ($audits as $audit)
            <tr>
              <td>
                #{{ $audit->user_id }} {{ $audit->user->name }}
              </td>
              <td>
                <div class="badge bg-primary">
                  {{ __($audit->event) }}
                </div>
              </td>
              <td>{{ __($audit->auditable_type) }}</td>
              <td>{{ $audit->ip_address }}</td>
              <td>{{ $audit->created_at->diffForHumans() }}</td>
              {{-- <td>
                <button onclick="openModal('audit-details', '{{ route('audits.show', $audit) }}')" class="btn btn-primary">
                  <i class="fa fa-file"></i>
                  Detalles
                </button>
              </td> --}}
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
@endsection

<x-modal
  id="audit-details"
  title="Detalles de la acción"
  dialogClass="modal-md"
/>

@push('script')
  <script src="{{ asset('assets/css/datatables.min.js') }}"></script>
  <script>
    new DataTable('#audits-table', {
      columnDefs: [
        { orderable: false, targets: 4 },
      ],
      order: false,
      scrollX: true,
      language: datatableES()
    })
  </script>
  <script>
    function openModal(modalId, route) {
      const $modalDetalleAviso = document.getElementById(modalId)
      const $modalDetalleAvisoContent = $modalDetalleAviso.querySelector('.modal-body')

      const modal = new bootstrap.Modal($modalDetalleAviso, {
        keyboard: false
      })

      fetch(route)
        .then(res => res.text())
        .then(result => {
          $modalDetalleAvisoContent.innerHTML = result
          modal.show()
        })

      $modalDetalleAviso.addEventListener('hide.bs.modal', () => {
        $modalDetalleAvisoContent.innerHTML = ''
      })
    }
  </script>
@endpush