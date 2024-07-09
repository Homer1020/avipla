@extends('layouts.dashboard')
@section('title', 'Dashboard')
@push('css')
  <style>
    .card-stats .card-body {
      padding: 1rem 1.5rem;
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
    <div class="col-lg-3">
      <div class="card card-stats mb-4">
        <div class="card-body">
          <div class="row">
            <div class="col">
              <h5 class="card-title h6 text-uppercase text-muted mb-0">Traffic</h5>
              <span class="h4 font-weight-bold mb-0">350,897</span>
            </div>
            <div class="col-auto">
              <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                <i class="fas fa-chart-bar"></i>
              </div>
            </div>
          </div>
          <p class="mt-3 mb-0 text-muted text-sm">
            <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
            <span class="text-nowrap">desde el último mes</span>
          </p>
        </div>
      </div>
    </div>

    <div class="col-lg-3">
      <div class="card card-stats mb-4">
        <div class="card-body">
          <div class="row">
            <div class="col">
              <h5 class="card-title h6 text-uppercase text-muted mb-0">Traffic</h5>
              <span class="h4 font-weight-bold mb-0">350,897</span>
            </div>
            <div class="col-auto">
              <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                <i class="fas fa-chart-bar"></i>
              </div>
            </div>
          </div>
          <p class="mt-3 mb-0 text-muted text-sm">
            <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
            <span class="text-nowrap">desde el último mes</span>
          </p>
        </div>
      </div>
    </div>

    <div class="col-lg-3">
      <div class="card card-stats mb-4">
        <div class="card-body">
          <div class="row">
            <div class="col">
              <h5 class="card-title h6 text-uppercase text-muted mb-0">Traffic</h5>
              <span class="h4 font-weight-bold mb-0">350,897</span>
            </div>
            <div class="col-auto">
              <div class="icon icon-shape bg-yellow text-white rounded-circle shadow">
                <i class="fas fa-chart-bar"></i>
              </div>
            </div>
          </div>
          <p class="mt-3 mb-0 text-muted text-sm">
            <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
            <span class="text-nowrap">desde el último mes</span>
          </p>
        </div>
      </div>
    </div>

    <div class="col-lg-3">
      <div class="card card-stats mb-4">
        <div class="card-body">
          <div class="row">
            <div class="col">
              <h5 class="card-title h6 text-uppercase text-muted mb-0">Traffic</h5>
              <span class="h4 font-weight-bold mb-0">350,897</span>
            </div>
            <div class="col-auto">
              <div class="icon icon-shape bg-info text-white rounded-circle shadow">
                <i class="fas fa-chart-bar"></i>
              </div>
            </div>
          </div>
          <p class="mt-3 mb-0 text-muted text-sm">
            <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
            <span class="text-nowrap">desde el último mes</span>
          </p>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-6">
      <div class="card">
        <div class="card-header">
          <svg class="svg-inline--fa fa-chart-area me-1" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="chart-area" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M64 64c0-17.7-14.3-32-32-32S0 46.3 0 64V400c0 44.2 35.8 80 80 80H480c17.7 0 32-14.3 32-32s-14.3-32-32-32H80c-8.8 0-16-7.2-16-16V64zm96 288H448c17.7 0 32-14.3 32-32V251.8c0-7.6-2.7-15-7.7-20.8l-65.8-76.8c-12.1-14.2-33.7-15-46.9-1.8l-21 21c-10 10-26.4 9.2-35.4-1.6l-39.2-47c-12.6-15.1-35.7-15.4-48.7-.6L135.9 215c-5.1 5.8-7.9 13.3-7.9 21.1v84c0 17.7 14.3 32 32 32z"></path></svg>
          Numero de afiliados al año
        </div>
        <div class="card-body">
          <canvas id="acquisitions"></canvas>
        </div>
      </div>
    </div>
  </div>
@endsection
@push('script')
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.3/dist/chart.umd.min.js"></script>

  <script>
    (async function() {
      const data = [
        { year: 2010, count: 10 },
        { year: 2011, count: 20 },
        { year: 2012, count: 15 },
        { year: 2013, count: 25 },
        { year: 2014, count: 22 },
        { year: 2015, count: 30 },
        { year: 2016, count: 28 },
      ];

      new Chart(
        document.getElementById('acquisitions'),
        {
          type: 'bar',
          data: {
            labels: data.map(row => row.year),
            datasets: [
              {
                label: 'Acquisitions by year',
                data: data.map(row => row.count)
              }
            ]
          }
        }
      )
    })()
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