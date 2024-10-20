@extends('layouts.dashboard')
@section('title', 'Modificar Afiliado')
@push('css')
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
@endpush
@section('content')
  <h1 class="mt-4 fs-3">Modificar Afiliado</h1>
  <ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('afiliados.index') }}">Afiliados</a></li>
    <li class="breadcrumb-item active">Modificar afiliado</li>
  </ol>

  <form action="{{ route('afiliados.update', $afiliado) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="card mb-4">
      <div class="card-body">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs nav-fill mb-3" id="myTab" role="tablist">
          <li class="nav-item" role="presentation">
            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#business-data"
              type="button" role="tab" aria-controls="home" aria-selected="true">Datos de la empresa</button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile"
              type="button" role="tab" aria-controls="profile" aria-selected="false">Actividades y personal</button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link" id="messages-tab" data-bs-toggle="tab" data-bs-target="#messages"
              type="button" role="tab" aria-controls="messages" aria-selected="false">Productos y servicios</button>
          </li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
          <div class="tab-pane active" id="business-data" role="tabpanel" tabindex="0">
            @include('afiliados.form.business')
          </div>
          <div class="tab-pane" id="profile" role="tabpanel" tabindex="0">
            @include('afiliados.form.personal-without-names')
          </div>
          <div class="tab-pane" id="messages" role="tabpanel" tabindex="0">
            @include('afiliados.form.products')
          </div>
          <button class="btn btn-success mt-4" type="submit">Guardar afiliado</button>
        </div>
      </div>
    </div>
  </form>
@endsection
@push('script')
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  @include('afiliados.script')
@endpush