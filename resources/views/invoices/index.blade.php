@extends('layouts.dashboard')
@section('title', 'Facturas')
@push('css')
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
  <link rel="stylesheet" href="{{ asset('assets/css/datatables.min.css') }}">
@endpush
@section('content')
  <h1 class="mt-4 fs-4">
    <i class="fas fa-file-invoice fa-sm"></i>
    Facturas
  </h1>
  <ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Facturas</li>
  </ol>
  @can('create', App\Models\Invoice::class)
    {{-- <div class="mb-4">
        <a href="{{ route('invoices.create') }}" class="btn btn-primary">Generar factura</a>
    </div> --}}
  @endcan
  <div class="card mb-4">
    
    <div class="card-body border-bottom">
      <form action="">
        <div class="row">
          @can('create', App\Models\Invoice::class)
            <div class="col-md-6 mb-3">
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
          @endcan
          <div class="mb-3 @cannot('create', App\Models\Invoice::class) col-md-12 @else col-md-6 @endcannot">
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
          <a href="{{ route('invoices.index') }}" class="btn btn-outline-secondary">
            <i class="fa fa-times"></i>
            Remover todos los filtros
          </a>
        @endif
      </form>
    </div>
    <div class="card-body">
      <table class="table table-bordered w-100" id="invoices-table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Factura N°</th>
            <th>Fecha</th>
            <th>Afiliado</th>
            <th>Monto</th>
            <th>Documento</th>
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
                    @if($invoice->avisoCobro)
                      <span class="text-truncate d-inline-block" style="max-width: 150px">
                        {{ $invoice->avisoCobro->afiliado->razon_social }}
                      </span>
                    @endif
                  </td>
                  <td>
                    {{ $invoice->monto_total }}$
                  </td>
                  <td>
                    @if ($invoice)
                      @can('view', $invoice)
                        <a target="_blank" href="{{ route('files.getFile', ['dir' => 'invoices', 'path' => $invoice->invoice_path]) }}" class="btn btn-primary">
                          <i class="fa fa-file-invoice"></i>
                          Ver documento
                        </a>
                      @endcan
                    @endif
                  </td>
                </tr>
            @endcan
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
@endsection

@push('script')
  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <script src="{{ asset('assets/css/datatables.min.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
  @can('create', App\Models\Afiliado::class)
    <script>
      $(document).ready(function() {
        $('#afiliado').select2({
          theme: 'bootstrap-5',
          allowClear: true,
        })
      })
    </script>
  @endcan
  <script>
    function getCurrentQuarterRange() {
        var currentMonth = new Date().getMonth(); // Mes actual (0-11)
        var quarterStartMonth = Math.floor(currentMonth / 3) * 3; // Mes de inicio del trimestre (0, 3, 6, 9)
        var startDate = moment().month(quarterStartMonth).startOf('month');
        var endDate = moment(startDate).endOf('month').add(2, 'months'); // El trimestre dura tres meses
        return [startDate, endDate];
      }
      function getLastQuarterRange() {
        var currentMonth = new Date().getMonth(); // Mes actual (0-11)
        var lastQuarterStartMonth = ((Math.floor(currentMonth / 3) - 1) * 3 + 12) % 12; // Mes de inicio del trimestre pasado
        var startDate = moment().month(lastQuarterStartMonth).startOf('month');
        var endDate = moment(startDate).endOf('month').add(2, 'months'); // El trimestre dura tres meses
        return [startDate, endDate];
      }
    $('input[name="date_range"]').daterangepicker({
      autoUpdateInput: false,
      showDropdowns: true,
      ranges: {
        'Mes actual': [moment().startOf('month'), moment().endOf('month')],
        'Mes pasado': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
        'Trimestre actual': getCurrentQuarterRange(), // Nuevo rango para el trimestre actual
        'Trimestre pasado': getLastQuarterRange() // Rango del trimestre pasado
      },
      opens: 'left',
      alwaysShowCalendars: true,
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
  @if (session('success'))
    <script>
        Swal.fire({
            icon: "success",
            title: "{{ session('success') }}"
        });
    </script>
  @endif

  <script src="https://cdn.datatables.net/buttons/3.2.0/js/dataTables.buttons.js"></script>
  <script src="https://cdn.datatables.net/buttons/3.2.0/js/buttons.bootstrap5.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/buttons/3.2.0/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/3.2.0/js/buttons.print.min.js"></script>
  <script>
    function getFileNameToExport(name = 'avipla_afiliados_') {
      var date = new Date();
      var dateString = date.getFullYear() + '-' + (date.getMonth() + 1) + '-' + date.getDate();
      var timeString = date.getHours() + '-' + date.getMinutes() + '-' + date.getSeconds();
      return name + dateString + '_' + timeString;
    }

    new DataTable('#invoices-table', {
      columnDefs: [
        {
          orderable: false,
          targets: 5
        }
      ],
      layout: {
        topEnd: {
          buttons: [
            {
              extend: 'excel',
              filename: getFileNameToExport(),
              exportOptions: {
                columns: [0, 1, 2, 3, 4],
                modifier: {
                  page: 'current'
                }
              }
            },
            {
              extend: 'pdf',
              filename: getFileNameToExport(),
              exportOptions: {
                columns: [0, 1, 2, 3, 4],
                modifier: {
                  page: 'current'
                }
              }
            }
          ]
        }
      },
      order: false,
      scrollX: true,
      language: datatableES(),
    })

    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl)
    })

  </script>
@endpush