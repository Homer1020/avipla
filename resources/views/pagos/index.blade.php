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

  <div class="card mb-4">
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered w-100" id="invoices-table">
          <thead>
            <tr>
              <th>ID</th>
              <th>Código</th>
              <th>Referencia</th>
              <th>Fecha</th>
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
                <td>
                  @if ($avisoCobro->pago && $avisoCobro->pago->referencia)
                    {{ '#' . $avisoCobro->pago->referencia }}
                  @else
                    N/A
                  @endif
                </td>
                <td>{{ $avisoCobro->created_at->format('d-m-Y') }}</td>
                <td> @include('partials.invoice_status') </td>
                <td>{{ $avisoCobro->pago ? $avisoCobro->pago->monto . '$' : 'N/A' }}</td>
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
        
      }
    })

    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl)
    })

  </script>
@endpush