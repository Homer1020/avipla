@extends('layouts.dashboard')
@section('title', 'Dashboard')
@push('css')
  <link rel="stylesheet" href="{{ asset('assets/css/datatables.min.css') }}">
  <style>
    .card-stats .card-body {
      padding: 1rem 1.5rem;
    }

    .card-stats h5 {
      font-size: 14px;
    }

    .icon {
      width: 3rem;
      height: 3rem;
    }

    .icon i {
      font-size: 2.25rem;
    }

    .icon-shape {
      display: inline-flex;
      padding: 12px;
      text-align: center;
      border-radius: 50%;
      align-items: center;
      justify-content: center;
    }

    .icon-shape i {
      font-size: 1.25rem;
    }

    .bg-yellow {
      background-color: #ffd600 !important;
    }
    
    .bg-warning {
      background-color: #fb6340 !important;
    }
  </style>
@endpush
@section('content')
  <h1 class="mt-4">Dashboard</h1>
  <ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">Dashboard</li>
  </ol>

  <div class="row">
    <div class="col-md-6 col-lg-4 col-xxl-3 mb-4 ">
      <x-stats.card
        title="Afiliados con todos los pagos al día"
        :number="$data['afiliados_al_dia']['cantidad']"
        :percentage="$data['afiliados_al_dia']['porcentaje']"
        metadata="de los afiliados"
      >
        <x-slot:icon>
          <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
            <i class="fas fa-check-circle"></i>
          </div>
        </x-slot:icon>
      </x-stats.card>
    </div>

    <div class="col-md-6 col-lg-4 col-xxl-3 mb-4 ">
      <x-stats.card
        title='Afiliados morosos {{ $currentCodigoAviso }}'
        :number="$data['afiliados_morosos']['cantidad']"
        :percentage="$data['afiliados_morosos']['porcentaje']"
        metadata="de los afiliados"
      >
        <x-slot:icon>
          <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
            <i class="fas fa-exclamation-circle"></i>
          </div>
        </x-slot:icon>
      </x-stats.card>
    </div>

    <div class="col-md-6 col-lg-4 col-xxl-3 mb-4 ">
      <x-stats.card
        title="Afiliados registrados en el sistema"
        :number="$data['afiliados']['cantidad']"
        :percentage="$data['afiliados']['porcentaje']"
        metadata="desde el último mes"
      >
        <x-slot:icon>
          <div class="icon icon-shape bg-yellow text-white rounded-circle shadow">
            <i class="fas fa-users"></i>
          </div>
        </x-slot:icon>
      </x-stats.card>
    </div>

    <div class="col-md-6 col-lg-4 col-xxl-3 mb-4 ">
      <x-stats.card
        title="Cantidad de boletines creados"
        :number="$data['boletines']['cantidad']"
        :percentage="$data['boletines']['porcentaje']"
        metadata="desde el último mes"
      >
        <x-slot:icon>
          <div class="icon icon-shape bg-success text-white rounded-circle shadow">
            <i class="fas fa-newspaper"></i>
          </div>
        </x-slot:icon>
      </x-stats.card>
    </div>

    <div class="col-md-6 col-lg-4 col-xxl-3 mb-4 ">
      <x-stats.card
        title="Cantidad de noticias creadas"
        :number="$data['noticias']['cantidad']"
        :percentage="$data['noticias']['porcentaje']"
        metadata="desde el último mes"
      >
        <x-slot:icon>
          <div class="icon icon-shape bg-info text-white rounded-circle shadow">
            <i class="fas fa-file-alt"></i>
          </div>
        </x-slot:icon>
      </x-stats.card>
    </div>

    <div class="col-md-6 col-lg-4 col-xxl-3 mb-4 ">
      <x-stats.card
        title="Numero de notificaciones sin leer"
        :number="Auth::user()->unreadNotifications()->count()"
        :percentage="(Auth::user()->unreadNotifications()->count() / (Auth::user()->notifications()->count() ?: 1)) * 100"
        metadata="de las notificaciones"
      >
        <x-slot:icon>
          <div class="icon icon-shape bg-dark text-white rounded-circle shadow">
            <i class="fas fa-bell"></i>
          </div>
        </x-slot:icon>
      </x-stats.card>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-6 mb-4">
      <div class="card" style="position: sticky; top: 70px;">
        <div class="card-header">
          <svg class="svg-inline--fa fa-chart-area me-1" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="chart-area" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M64 64c0-17.7-14.3-32-32-32S0 46.3 0 64V400c0 44.2 35.8 80 80 80H480c17.7 0 32-14.3 32-32s-14.3-32-32-32H80c-8.8 0-16-7.2-16-16V64zm96 288H448c17.7 0 32-14.3 32-32V251.8c0-7.6-2.7-15-7.7-20.8l-65.8-76.8c-12.1-14.2-33.7-15-46.9-1.8l-21 21c-10 10-26.4 9.2-35.4-1.6l-39.2-47c-12.6-15.1-35.7-15.4-48.7-.6L135.9 215c-5.1 5.8-7.9 13.3-7.9 21.1v84c0 17.7 14.3 32 32 32z"></path></svg>
          Avisos de cobro por mes
        </div>
        <div class="card-body">
          <canvas id="acquisitions"></canvas>
        </div>
      </div>
    </div>

    <div class="col-lg-6 mb-4">
      <div class="card">
        <div class="card-header">
          <svg class="svg-inline--fa fa-chart-area me-1" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="chart-area" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M64 64c0-17.7-14.3-32-32-32S0 46.3 0 64V400c0 44.2 35.8 80 80 80H480c17.7 0 32-14.3 32-32s-14.3-32-32-32H80c-8.8 0-16-7.2-16-16V64zm96 288H448c17.7 0 32-14.3 32-32V251.8c0-7.6-2.7-15-7.7-20.8l-65.8-76.8c-12.1-14.2-33.7-15-46.9-1.8l-21 21c-10 10-26.4 9.2-35.4-1.6l-39.2-47c-12.6-15.1-35.7-15.4-48.7-.6L135.9 215c-5.1 5.8-7.9 13.3-7.9 21.1v84c0 17.7 14.3 32 32 32z"></path></svg>
          Estados de avisos de cobro
        </div>
        <div class="card-body">
          <canvas id="avisos-cobros"></canvas>
        </div>
      </div>
    </div>

    <div class="col-lg-12 mb-4">
      <div class="card">
        <div class="card-header">
          <svg class="svg-inline--fa fa-chart-area me-1" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="chart-area" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M64 64c0-17.7-14.3-32-32-32S0 46.3 0 64V400c0 44.2 35.8 80 80 80H480c17.7 0 32-14.3 32-32s-14.3-32-32-32H80c-8.8 0-16-7.2-16-16V64zm96 288H448c17.7 0 32-14.3 32-32V251.8c0-7.6-2.7-15-7.7-20.8l-65.8-76.8c-12.1-14.2-33.7-15-46.9-1.8l-21 21c-10 10-26.4 9.2-35.4-1.6l-39.2-47c-12.6-15.1-35.7-15.4-48.7-.6L135.9 215c-5.1 5.8-7.9 13.3-7.9 21.1v84c0 17.7 14.3 32 32 32z"></path></svg>
          Recibos por cobrar
        </div>
        <div class="card-body">
          <table class="table table-bordered" id="invoices-table">
            <thead>
              <tr>
                <td>ID</td>
                <td>Razón social</td>
                <td>Emitido hace</td>
                <td>Fecha limite</td>
                <td>Estado del aviso</td>
                <td>Acciones</td>
              </tr>
            </thead>
            <tbody>
              @foreach ($avisosCobrosPorPagar as $avisoCobro)
                <tr>
                  <td>#{{ $avisoCobro->id }}</td>
                  <td>{{ $avisoCobro->afiliado->razon_social }}</td>
                <td>{{ $avisoCobro->created_at->diffForHumans() }}</td>
                <td>{{ $avisoCobro->fecha_limite }}</td>
                  <td>{{ $avisoCobro->estado }}</td>
                  <td>
                    <a class="btn btn-success" href="{{ route('avisos-cobro.show', $avisoCobro) }}">
                      <i class="fa fa-eye"></i>
                      Detalles
                    </a>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection
@push('script')
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.3/dist/chart.umd.min.js"></script>
  <script src="{{ asset('assets/css/datatables.min.js') }}"></script>

  <script>
    (async function() {

      const avisosCobrosAgrupados = JSON.parse(`{!! $avisosCobrosAgrupados !!}`)

      new Chart(
        document.getElementById('acquisitions'),
        {
          type: 'bar',
          data: {
            labels: Object.keys(avisosCobrosAgrupados),
            datasets: [
              {
                label: 'Avisos de cobro',
                data: Object.values(avisosCobrosAgrupados).map(item => item.length)
              }
            ]
          }
        }
      )

      const avisosCobrosEstados = JSON.parse(`{!! $avisosCobrosEstados !!}`)

      new Chart(
        document.getElementById('avisos-cobros'),
        {
          type: 'doughnut',
          data: {
            labels: Object.keys(avisosCobrosEstados),
            datasets: [
              {
                label: 'Estado',
                data: Object.values(avisosCobrosEstados).map(item => item.length)
              }
            ]
          }
        }
      )
    })()

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
      }
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
@endpush