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

  @if($data['recibos']['mora'])
    <div class="alert alert-danger">Tienes pagos {{ $data['recibos']['mora'] }} pendientes</div>
  @else
    <div class="alert alert-success">Estas al día. No tienes pagos pendientes</div>
  @endif

  <div class="row">
    <div class="col-md-6 col-lg-4 mb-4 ">
        <x-stats.card
            title="Recibos pagados"
            :number="$data['recibos']['pagados']"
            :percentage="($data['recibos']['pagados'] / ($data['recibos']['total'] ?: 1)) * 100"
            metadata="de tus recibos"
        >
            <x-slot:icon>
            <div class="icon icon-shape bg-success text-white rounded-circle shadow">
                <i class="fas fa-check-circle"></i>
            </div>
            </x-slot:icon>
        </x-stats.card>
    </div>

    <div class="col-md-6 col-lg-4 mb-4 ">
        <x-stats.card
            title="Recibos en mora"
            :number="$data['recibos']['mora']"
            :percentage="($data['recibos']['mora'] / ($data['recibos']['total'] ?: 1)) * 100"
            metadata="de tus recibos"
        >
            <x-slot:icon>
                <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                    <i class="fas fa-exclamation-circle"></i>
                </div>
            </x-slot:icon>
        </x-stats.card>
    </div>

    <div class="col-md-6 col-lg-4 mb-4 ">
      <x-stats.card
        title="Notificaciones sin leer"
        :number="Auth::user()->unreadNotifications()->count()"
        :percentage="(Auth::user()->unreadNotifications()->count() / (Auth::user()->notifications()->count() ?: 1)) * 100"
        metadata="de las notificaciones"
      >
        <x-slot:icon>
          <div class="icon icon-shape bg-info text-white rounded-circle shadow">
            <i class="fas fa-bell"></i>
          </div>
        </x-slot:icon>
      </x-stats.card>
    </div>
  </div>

  <div class="row">
    @if ($recibosPorEstado->count())
      <div class="col-lg-5 mb-4">
        <div class="card h-100">
          <div class="card-header">
            <svg class="svg-inline--fa fa-chart-area me-1" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="chart-area" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M64 64c0-17.7-14.3-32-32-32S0 46.3 0 64V400c0 44.2 35.8 80 80 80H480c17.7 0 32-14.3 32-32s-14.3-32-32-32H80c-8.8 0-16-7.2-16-16V64zm96 288H448c17.7 0 32-14.3 32-32V251.8c0-7.6-2.7-15-7.7-20.8l-65.8-76.8c-12.1-14.2-33.7-15-46.9-1.8l-21 21c-10 10-26.4 9.2-35.4-1.6l-39.2-47c-12.6-15.1-35.7-15.4-48.7-.6L135.9 215c-5.1 5.8-7.9 13.3-7.9 21.1v84c0 17.7 14.3 32 32 32z"></path></svg>
            Estado de mis recibos
          </div>
          <div class="card-body d-flex align-items-center">
            <canvas id="avisos-cobros"></canvas>
          </div>
        </div>
      </div>
    @else 
      <div class="col-12">
        <div class="alert alert-info">
          Aún no tienes recibos
        </div>
      </div>
    @endif
  </div>
@endsection
@push('script')
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.3/dist/chart.umd.min.js"></script>
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
    (async ()=> {
        const avisosCobrosEstados = JSON.parse(`{!! $recibosPorEstado !!}`)

        new Chart(
            document.getElementById('avisos-cobros'),
            {
            type: 'doughnut',
            data: {
                labels: Object.keys(avisosCobrosEstados),
                datasets: [
                {
                    label: 'Pagos',
                    data: Object.values(avisosCobrosEstados).map(item => item.length)
                }
                ]
            }
            }
        )
    })()
  </script>
@endpush