@extends('layouts.dashboard')
@section('title', 'Base de datos')
@push('css')
  <link rel="stylesheet" href="{{ asset('assets/css/datatables.min.css') }}">
@endpush
@section('content')
<h1 class="mt-4 fs-4">
  <i class="fas fa-database fa-sm"></i> 
  Base de datos
</h1>
<ol class="breadcrumb mb-4">
  <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
  <li class="breadcrumb-item active">Base de datos</li>
</ol>
<div class="row mt-3">
  <div class="col-md-12 mb-3">
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalBackup">
      <i class="fas fa-database"></i>
      Crear Respaldo
    </button>
  </div>
  <div class="col-md-12 mb-3 mb-md-0">
    <div class="card shadow-sm">
      <div class="card-body">
        <table class="table table-bordered" id="backups-table">
          <thead>
            <th class="text-start">Fecha</th>
            <th>Encargado</th>
            <th>Nombre</th>
            <th>Nota</th>
            <th>Estado</th>
            <th>Descargar</th>
          </thead>
          <tbody>
            @foreach ($backups as $backup)
              <tr>
                <td class="text-start">{{ $backup->created_at->format('Y-m-d') }}</td>
                <td>{{ $backup->user->name }}</td>
                <td>{{ $backup->filename }}</td>
                <td>{{ $backup->note }}</td>
                <td>{!! $backup->formatStatus() !!}</td>
                <td>
                  <a href="{{ route('database.downloadBackup', $backup) }}" class="@if($backup->status === 0) disabled @endif btn btn-primary">
                    <i class="fas fa-cloud-download-alt"></i>
                    Descargar
                  </a>
                  {{-- <a href="#" class="@if($backup->status === 0) disabled @endif btn btn-warning">
                    <i class="fas fa-cloud-upload-alt"></i>
                    Restaurar
                  </a>
                  <a href="#" class="@if($backup->status === 0) disabled @endif btn btn-danger">
                    <i class="fa fa-trash"></i>
                    Eliminar
                  </a> --}}
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalBackup" tabindex="-1" aria-labelledby="modalBackupLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalBackupLabel">Respaldar Base de Datos</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="form-backup" action="{{ route('database.backup') }}" method="POST">
          @csrf
          <div class="mb-3">
            <label for="filename" class="form-label">Nombre del archivo</label>
            <input type="text" id="filename" name="filename" class="form-control">
          </div>
          <div class="mb-3">
            <label for="note" class="form-label">Nota</label>
            <textarea name="note" id="note" cols="7" class="form-control"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button form="form-backup" type="submit" class="btn btn-primary">
          <i class="fas fa-database"></i> Respaldar Base de Datos
        </button>
      </div>
    </div>
  </div>
</div>

@push('script')
  @if (session('success'))
    <script>
      Swal.fire({
        icon: "success",
        title: "{{ session('success') }}"
      });
    </script>
  @endif

  @if (session('error'))
    <script>
      Swal.fire({
        icon: "error",
        title: "{{ session('error') }}"
      });
    </script>
  @endif

  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <script src="{{ asset('assets/css/datatables.min.js') }}"></script>
  <script>
    new DataTable('#backups-table', {
      columnDefs: [
        { orderable: false, targets: 5 },
      ],
      order: false,
      scrollX: false,
      language: datatableES()
    })
  </script>
@endpush
@endsection