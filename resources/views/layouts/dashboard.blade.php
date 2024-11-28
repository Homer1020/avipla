<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Avipla - @yield('title')</title>
        <!-- FAVICON -->
        <link rel="shortcut icon" href="{{ asset('assets/img/logo.png') }}" type="image/png">
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
        <meta name="robots" content="noindex, nofollow"> <!-- The dashboard isnt should be indexed -->
        @stack('css')
        <style>
            .sb-nav-link-icon {
                width: 18px;
                text-align: center;
            }

            .note-toolbar button::after {
                display: none !important;
            }

            .note-color-all.open .note-dropdown-menu {
                display: flex;
            }

            .note-modal-footer {
                text-align: right;
                padding-left: 30px;
                padding-right: 30px;
                height: auto;
            }

            .note-modal-footer .note-btn {
                float: none;
                margin-bottom: 10px;
            }

            h1 {
                text-transform: capitalize;
            }

            table th {
                white-space: nowrap;
            }
        </style>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="{{ route('dashboard') }}">
                <img src="{{ asset('assets/img/logowhite.png') }}" alt="Logo AVIPLA" width="50" class="me-2">
                Intranet
            </a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group d-none">
                    <input class="form-control" type="text" placeholder="Buscar..." aria-label="Buscar..." aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                @php $notifications = Auth::user()->unreadNotifications @endphp
                <li class="nav-item dropdown">
                    <a class="nav-link" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">
                        <i class="fa fa-bell fa-fw"></i>
                        <div class="badge bg-danger">
                            {{ $notifications->count() }}
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <h6 class="dropdown-header text-uppercase">Notificaciones sin leer ({{ $notifications->count() }})</h6>
                        <li><hr class="dropdown-divider"></li>
                        @forelse ($notifications as $notification)
                            <li>
                                <a
                                    class="dropdown-item d-flex align-items-center"
                                    href="{{ $notification->data['url'] }}"
                                >
                                    <div class="flex-shrink-0">
                                        <div style="width: 35px; height: 35px;" class="rounded bg text d-flex align-items-center justify-content-center">
                                            <i class="{{ $notification->data['icon'] }} fa-xl"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <p class="m-0">
                                        {{ $notification->data['message'] }}
                                        </p>
                                        <small>{{ $notification->created_at->diffForHumans() }}</small>
                                    </div>
                                </a>
                            </li>
                        @empty
                            <li>
                                <div class="p-3 py-1">
                                    <p class="m-0 text-muted d-flex align-items-center justify-content-center">
                                        <small>
                                            Sin novedades
                                        </small>
                                    </p>
                                </div>
                            </li>
                        @endforelse
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item text-center" href="{{ route('notifications.index') }}">Todas las notificaciones</a></li>
                    </ul>
                  </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li>
                            <a
                                class="dropdown-item {{ request()->routeIs('profile.show') ? 'active' : '' }}"
                                href="{{ route('profile.show') }}"
                            >Perfil de usuario</a>
                            @if (Auth::user()->afiliado && Auth::user()->tipo_afiliado === 0)
                                <a
                                    class="dropdown-item {{ request()->routeIs('profile.showPresidente') ? 'active' : '' }}"
                                    href="{{ route('profile.showPresidente') }}"
                                >Perfil del presidente</a>
                                <a
                                    class="dropdown-item {{ request()->routeIs('profile.showDirector') ? 'active' : '' }}"
                                    href="{{ route('profile.showDirector') }}"
                                >Perfil de administración y cobranzas</a>
                            @endif
                        </li>
                        <li><hr class="dropdown-divider" /></li>
                        <li>
                            <form action="{{ route('auth.logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item">Cerrar sesión</button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                @include('partials.dashboard_nav')
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        @yield('content')
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class=" small">
                            <div class="text-muted">Copyright &copy; avipla.com {{ date('Y') }}</div>
                            <div>
                                <a href="#">Políticas de privacidad</a>
                                &middot;
                                <a href="#">Términos y condiciones</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
        <script>
            function datatableES() {
                return ({
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
                    
                })
            }

            function initTooltips() {
                var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
                var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                    return new bootstrap.Tooltip(tooltipTriggerEl)
                })
            }

            initTooltips()

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

            async function handleSubmitForm(form, method = 'POST', cb = null, needConfirmation = false) {
                if(needConfirmation) {
                    const result = await Swal.fire({
                        title: "¿Estas seguro?",
                        text: "¡Esta acción no se puede revertir!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Si, eliminalo!",
                        cancelButtonText: "Cancelar"
                    })

                    if(!result.isConfirmed) return;
                }

                const fd = new FormData(form)

                fetch(form.action, {
                    method,
                    body: JSON.stringify({
                        invoice_status: fd.get('invoice_status'),
                        observaciones: fd.get('observaciones')
                    }),
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(resp => resp.json())
                .then(result => {
                    if(result.ok) {
                        Swal.fire({
                            title: result.title,
                            text: result.message,
                            icon: "success",
                            confirmButtonColor: "#3085d6"
                        })
                        .then(() => {
                            if(cb && typeof cb === 'function') cb()
                        })
                    }
                })                
            }

            function handleSubmitNormalForm(form, method = 'POST', cb = null) {
                const fd = new FormData(form)
                fd.append('_method', method)

                fetch(form.action, {
                    method: 'POST',
                    body: fd,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(resp => resp.json())
                .then(result => {
                    const data = result.data || result
                    if(data) {
                        Swal.fire({
                            title: data.title,
                            text: data.message,
                            icon: "success",
                            confirmButtonColor: "#3085d6"
                        })
                        .then(() => {
                            if(cb && typeof cb === 'function') cb()
                        })
                    }
                })                
            }
        </script>
        <script src="{{ asset('js/scripts.js') }}"></script>
        @if (request()->user()->afiliado)
            <!-- Smartsupp Live Chat script -->
            <script type="text/javascript">
                var _smartsupp = _smartsupp || {};
                _smartsupp.key = '84f1ef21e09e48dc764055210e09c61f35fb1870';
                window.smartsupp||(function(d) {
                var s,c,o=smartsupp=function(){ o._.push(arguments)};o._=[];
                s=d.getElementsByTagName('script')[0];c=d.createElement('script');
                c.type='text/javascript';c.charset='utf-8';c.async=true;
                c.src='https://www.smartsuppchat.com/loader.js?';s.parentNode.insertBefore(c,s);
                })(document);
            </script>
            <noscript> Powered by <a href=“https://www.smartsupp.com” target=“_blank”>Smartsupp</a></noscript>
        @endif
        @stack('script')
    </body>
</html>
