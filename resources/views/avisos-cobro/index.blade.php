@extends('layouts.dashboard')
@section('title', 'Avisos de cobro')
@push('css')
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
  <link rel="stylesheet" href="{{ asset('assets/css/datatables.min.css') }}">
@endpush
@section('content')
  <h1 class="mt-4">Avisos de cobro</h1>
  <ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Avisos de cobro</li>
  </ol>
  @can('create', App\Models\AvisoCobro::class)
    <div class="mb-4">
      <a href="{{ route('avisos-cobro.create') }}" class="btn btn-primary">Generar aviso</a>
    </div>
  @endcan

  <div class="card mb-4">
    <div class="card-body">
      <form action="" class="mb-4">
        <div class="row">
          <div class="col-md-6 col-xl-4 mb-3">
            <label for="afiliado" class="form-label">Afiliado</label>
            <select
              name="afiliado"
              id="afiliado"
              class="selectpicker w-100"
              data-placeholder="Seleccione un afiliado"
            >
              <option></option>
              @foreach ($afiliados as $afiliado)
                <option
                  value="{{ $afiliado->id }}"
                  @selected(request()->has('afiliado') ? (intval(request()->input('afiliado')) === $afiliado->id) : false)
                >{{ $afiliado->razon_social }}</option>
              @endforeach
            </select>
          </div>
          <div class="col-md-6 col-xl-4 mb-3">
            <label for="estado" class="form-label">Estado</label>
            <select
              name="estado"
              id="estado"
              class="form-select"
              data-placeholder="Seleccione un estado"
            >
              <option></option>
              <option
                value="PENDIENTE"
                @selected(request()->has('estado') ? (request()->input('estado') === 'PENDIENTE') : false)
              >PENDIENTE</option>
              <option
                value="REVISION"
                @selected(request()->has('estado') ? (request()->input('estado') === 'REVISION') : false)
              >REVISION</option>
              <option
                value="CONCILIADO"
                @selected(request()->has('estado') ? (request()->input('estado') === 'CONCILIADO') : false)
              >CONCILIADO</option>
              <option
                value="DEVUELTO"
                @selected(request()->has('estado') ? (request()->input('estado') === 'DEVUELTO') : false)
              >DEVUELTO</option>
            </select>
          </div>

          <div class="col-md-6 col-xl-4 mb-3">
            <label for="date_range" class="form-label">Rango de fechas</label>
            <input type="text" name="date_range" id="date_range" class="form-control" value="{{ request()->has('date_range') ? request()->input('date_range') : '' }}" autocomplete="off">
          </div>
        </div>

        <button type="submit" class="btn btn-outline-primary me-2">
          <i class="fa fa-filter"></i>
          Filtrar recibos
        </button>

        @if(
          request()->input('afiliado') ||
          request()->input('estado') ||
          request()->input('date_range')
        )
          <a href="{{ route('avisos-cobro.index') }}" class="btn btn-outline-secondary">
            <i class="fa fa-times"></i>
            Remover todos los filtros
          </a>
        @endif
      </form>
      <table class="table table-bordered w-100" id="invoices-table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Código</th>
            <th>Fecha</th>
            <th>Afiliado</th>
            <th>Estado</th>
            <th>Monto</th>
            <th>Acciones</th>
          </tr>
        </thead>
    
        <tbody>
          @foreach ($avisosCobros as $avisoCobro)
            <tr>
              <td>#{{ $avisoCobro->id }}</td>
              <td>#{{ $avisoCobro->codigo_aviso }}</td>
              <td>{{ $avisoCobro->created_at->format('Y-m-d') }}</td>
              <td>
                <span class="text-truncate d-inline-block" style="max-width: 150px">
                  {{ $avisoCobro->afiliado->razon_social }}
                </span>
              </td>
              <td>
                @include('partials.invoice_status')
              </td>
              <td>{{ $avisoCobro->monto_total }}$</td>
              <td>
                @php
                  $queryParams = request()->query();
                @endphp
                @can('view', $avisoCobro)
                  <a class="btn btn-success" href="{{ route('avisos-cobro.show', $avisoCobro) }}{{ !empty($queryParams) ? '?' . http_build_query($queryParams) : '' }}">
                    <i class="fa fa-eye"></i>
                    Detalles
                  </a>
                @endcan
                @if ($avisoCobro->invoice)
                  @can('view', $avisoCobro->invoice)
                    <a target="_blank" href="{{ route('files.getFile', ['dir' => 'invoices', 'path' => $avisoCobro->invoice->invoice_path]) }}" class="btn btn-primary">
                      <i class="fa fa-file-invoice"></i>
                      Ver factura
                    </a>
                  @endcan
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
  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script src="{{ asset('assets/css/datatables.min.js') }}"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
  <script>
      $(document).ready(function() {
          $('#afiliado').select2({
              theme: 'bootstrap-5',
              allowClear: true,
          })

          $('#estado').select2({
              theme: 'bootstrap-5',
              allowClear: true,
          })
      })
      $('input[name="date_range"]').daterangepicker({
        autoUpdateInput: false,
        showDropdowns: true,
        // autoApply: true,
        "locale": {
          "format": "YYYY/MM/DD",
          "separator": " - ",
          "applyLabel": "Aplicar",
          "cancelLabel": "Limpiar",
          "fromLabel": "Desde",
          "toLabel": "Hasta",
          "customRangeLabel": "Personalizado",
          "weekLabel": "S",
          "daysOfWeek": [
              "Do",
              "Lu",
              "Ma",
              "Mi",
              "Ju",
              "Vi",
              "Sa"
          ],
          "monthNames": [
              "Enero",
              "Febrero",
              "Marzo",
              "Abril",
              "Mayo",
              "Junio",
              "Julio",
              "Agosto",
              "Septiembre",
              "Octubre",
              "Noviembre",
              "Diciembre"
          ],
          "firstDay": 1
      },
      });
      $('input[name="date_range"]').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('YYYY/MM/DD') + ' - ' + picker.endDate.format('YYYY/MM/DD'))
      })

      $('input[name="date_range"]').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('')
      })
  </script>

  @if (request()->has('afiliado'))
    <script>
      $('#afiliado').val({{ request()->input('afiliado') }}).trigger('change');
    </script>
  @endif

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
          targets: 6
        }
      ],
      stateSave: true,
      order: false,
      scrollX: false,
      language: {
        // url: '//cdn.datatables.net/plug-ins/2.0.8/i18n/es-ES.json',
      },
    })

    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl)
    })

  </script>
@endpush