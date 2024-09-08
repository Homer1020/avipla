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

  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">Open modal for @mdo</button>

  <x-modal
    id="detall-aviso"
  />

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
      <div class="table-responsive">
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
  </div>
@endsection

@push('script')
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
        alwaysShowCalendars: true,
        opens: 'left',
        // autoApply: true,
        ranges: {
          'Mes actual': [moment().startOf('month'), moment().endOf('month')],
          'Mes pasado': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
          'Trimestre actual': getCurrentQuarterRange(), // Nuevo rango para el trimestre actual
          'Trimestre pasado': getLastQuarterRange() // Rango del trimestre pasado
        },
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
          "processing": "Procesando...",
          "lengthMenu": "Mostrar _MENU_ registros",
          "zeroRecords": "No se encontraron resultados",
          "emptyTable": "Ningún dato disponible en esta tabla",
          "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
          "infoFiltered": "(filtrado de un total de _MAX_ registros)",
          "search": "Buscar:",
          "loadingRecords": "Cargando...",
          "aria": {
            "sortAscending": ": Activar para ordenar la columna de manera ascendente",
            "sortDescending": ": Activar para ordenar la columna de manera descendente"
          },
          "buttons": {
            "copy": "Copiar",
            "colvis": "Visibilidad",
            "collection": "Colección",
            "colvisRestore": "Restaurar visibilidad",
            "copyKeys": "Presione ctrl o u2318 + C para copiar los datos de la tabla al portapapeles del sistema. <br /> <br /> Para cancelar, haga clic en este mensaje o presione escape.",
            "copySuccess": {
              "1": "Copiada 1 fila al portapapeles",
              "_": "Copiadas %ds fila al portapapeles"
            },
            "copyTitle": "Copiar al portapapeles",
            "csv": "CSV",
            "excel": "Excel",
            "pageLength": {
              "-1": "Mostrar todas las filas",
              "_": "Mostrar %d filas"
            },
            "pdf": "PDF",
            "print": "Imprimir",
            "renameState": "Cambiar nombre",
            "updateState": "Actualizar",
            "createState": "Crear Estado",
            "removeAllStates": "Remover Estados",
            "removeState": "Remover",
            "savedStates": "Estados Guardados",
            "stateRestore": "Estado %d"
          },
          "autoFill": {
            "cancel": "Cancelar",
            "fill": "Rellene todas las celdas con <i>%d</i>",
            "fillHorizontal": "Rellenar celdas horizontalmente",
            "fillVertical": "Rellenar celdas verticalmente"
          },
          "decimal": ",",
          "searchBuilder": {
            "add": "Añadir condición",
            "button": {
              "0": "Constructor de búsqueda",
              "_": "Constructor de búsqueda (%d)"
            },
            "clearAll": "Borrar todo",
            "condition": "Condición",
            "conditions": {
              "date": {
                "before": "Antes",
                "between": "Entre",
                "empty": "Vacío",
                "equals": "Igual a",
                "notBetween": "No entre",
                "not": "Diferente de",
                "after": "Después",
                "notEmpty": "No Vacío"
              },
              "number": {
                "between": "Entre",
                "equals": "Igual a",
                "gt": "Mayor a",
                "gte": "Mayor o igual a",
                "lt": "Menor que",
                "lte": "Menor o igual que",
                "notBetween": "No entre",
                "notEmpty": "No vacío",
                "not": "Diferente de",
                "empty": "Vacío"
              },
              "string": {
                "contains": "Contiene",
                "empty": "Vacío",
                "endsWith": "Termina en",
                "equals": "Igual a",
                "startsWith": "Empieza con",
                "not": "Diferente de",
                "notContains": "No Contiene",
                "notStartsWith": "No empieza con",
                "notEndsWith": "No termina con",
                "notEmpty": "No Vacío"
              },
              "array": {
                "not": "Diferente de",
                "equals": "Igual",
                "empty": "Vacío",
                "contains": "Contiene",
                "notEmpty": "No Vacío",
                "without": "Sin"
              }
            },
            "data": "Data",
            "deleteTitle": "Eliminar regla de filtrado",
            "leftTitle": "Criterios anulados",
            "logicAnd": "Y",
            "logicOr": "O",
            "rightTitle": "Criterios de sangría",
            "title": {
              "0": "Constructor de búsqueda",
              "_": "Constructor de búsqueda (%d)"
            },
            "value": "Valor"
          },
          "searchPanes": {
            "clearMessage": "Borrar todo",
            "collapse": {
              "0": "Paneles de búsqueda",
              "_": "Paneles de búsqueda (%d)"
            },
            "count": "{total}",
            "countFiltered": "{shown} ({total})",
            "emptyPanes": "Sin paneles de búsqueda",
            "loadMessage": "Cargando paneles de búsqueda",
            "title": "Filtros Activos - %d",
            "showMessage": "Mostrar Todo",
            "collapseMessage": "Colapsar Todo"
          },
          "select": {
            "cells": {
              "1": "1 celda seleccionada",
              "_": "%d celdas seleccionadas"
            },
            "columns": {
              "1": "1 columna seleccionada",
              "_": "%d columnas seleccionadas"
            },
            "rows": {
              "1": "1 fila seleccionada",
              "_": "%d filas seleccionadas"
            }
          },
          "thousands": ".",
          "datetime": {
            "previous": "Anterior",
            "hours": "Horas",
            "minutes": "Minutos",
            "seconds": "Segundos",
            "unknown": "-",
            "amPm": [
              "AM",
              "PM"
            ],
            "months": {
              "0": "Enero",
              "1": "Febrero",
              "2": "Marzo",
              "3": "Abril",
              "4": "Mayo",
              "5": "Junio",
              "6": "Julio",
              "7": "Agosto",
              "8": "Septiembre",
              "9": "Octubre",
              "10": "Noviembre",
              "11": "Diciembre"
            },
            "weekdays": {
              "0": "Dom",
              "1": "Lun",
              "2": "Mar",
              "3": "Mié",
              "4": "Jue",
              "5": "Vie",
              "6": "Sáb"
            },
            "next": "Próximo"
          },
          "editor": {
            "close": "Cerrar",
            "create": {
              "button": "Nuevo",
              "title": "Crear Nuevo Registro",
              "submit": "Crear"
            },
            "edit": {
              "button": "Editar",
              "title": "Editar Registro",
              "submit": "Actualizar"
            },
            "remove": {
              "button": "Eliminar",
              "title": "Eliminar Registro",
              "submit": "Eliminar",
              "confirm": {
                "1": "¿Está seguro de que desea eliminar 1 fila?",
                "_": "¿Está seguro de que desea eliminar %d filas?"
              }
            },
            "error": {
              "system": "Ha ocurrido un error en el sistema (<a target=\"\\\"rel=\"\\nofollow\"href=\"\\\">Más información&lt;\\/a&gt;).</a>"
            },
            "multi": {
              "title": "Múltiples Valores",
              "restore": "Deshacer Cambios",
              "noMulti": "Este registro puede ser editado individualmente, pero no como parte de un grupo.",
              "info": "Los elementos seleccionados contienen diferentes valores para este registro. Para editar y establecer todos los elementos de este registro con el mismo valor, haga clic o pulse aquí, de lo contrario conservarán sus valores individuales."
            }
          },
          "info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
          "stateRestore": {
            "creationModal": {
              "button": "Crear",
              "name": "Nombre:",
              "order": "Clasificación",
              "paging": "Paginación",
              "select": "Seleccionar",
              "columns": {
                "search": "Búsqueda de Columna",
                "visible": "Visibilidad de Columna"
              },
              "title": "Crear Nuevo Estado",
              "toggleLabel": "Incluir:",
              "scroller": "Posición de desplazamiento",
              "search": "Búsqueda",
              "searchBuilder": "Búsqueda avanzada"
            },
            "removeJoiner": "y",
            "removeSubmit": "Eliminar",
            "renameButton": "Cambiar Nombre",
            "duplicateError": "Ya existe un Estado con este nombre.",
            "emptyStates": "No hay Estados guardados",
            "removeTitle": "Remover Estado",
            "renameTitle": "Cambiar Nombre Estado",
            "emptyError": "El nombre no puede estar vacío.",
            "removeConfirm": "¿Seguro que quiere eliminar %s?",
            "removeError": "Error al eliminar el Estado",
            "renameLabel": "Nuevo nombre para %s:"
          },
          "infoThousands": "."
        
      },
    })

    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl)
    })

  </script>
@endpush