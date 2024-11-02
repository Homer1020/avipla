@extends('layouts.dashboard')
@section('title', 'Importar excel')
@section('content')
<h1 class="mt-4 fs-4">
  <i class="fa fa-handshake fa-sm"></i>
  Importar afiliados
</h1>
<ol class="breadcrumb mb-4">
  <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
  <li class="breadcrumb-item"><a href="{{ route('afiliados.index') }}">Afiliados</a></li>
  <li class="breadcrumb-item active">Importar excel</li>
</ol>

<div class="card mb-4">
  <div class="card-header">
    <p class="mb-0">Importar excel</p>
  </div>
  <div class="card-body">
    <a class="btn btn-primary mb-3" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
      <i class="fa fa-info-circle"></i>
      Leer instrucciones
  </a>
  <div class="collapse" id="collapseExample">
    <div class="alert alert-info">
      <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Error illum quisquam perferendis aliquid necessitatibus neque qui, perspiciatis rem, vero nulla enim. Eveniet atque molestias in repellat suscipit, sequi quia cum?</p>
    </div>
  </div>
    <form action="{{ route('afiliados.importExcel') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="mb-3">
        <label class="form-label" for="afiliados">Excel</label>
        <input
          class="form-control"
          type="file"
          name="afiliado"
          id="afiliados"
          required
        >
      </div>
      <button class="btn btn-success" type="submit">Importar excel</button>
    </form>
  </div>
</div>
@endsection