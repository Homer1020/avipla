@extends('layouts.dashboard')
@section('title', 'Crear Afiliado')
@section('content')
<h1 class="mt-4">Crear Afiliado</h1>
<ol class="breadcrumb mb-4">
  <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
  <li class="breadcrumb-item"><a href="{{ route('afiliados.index') }}">Afiliados</a></li>
  <li class="breadcrumb-item active">Crear Afiliado</li>
</ol>

<form action="{{ route('afiliados.store') }}" method="POST">
  @csrf
  <!-- Nav tabs -->
  <ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
      <button
        class="nav-link active"
        id="home-tab"
        data-bs-toggle="tab"
        data-bs-target="#business-data"
        type="button"
        role="tab"
        aria-controls="home"
        aria-selected="true"
      >Paso #1</button>
    </li>
    <li class="nav-item" role="presentation">
      <button
        class="nav-link"
        id="profile-tab"
        data-bs-toggle="tab"
        data-bs-target="#profile"
        type="button"
        role="tab"
        aria-controls="profile"
        aria-selected="false"
      >Paso #2</button>
    </li>
    <li class="nav-item" role="presentation">
      <button
        class="nav-link"
        id="messages-tab"
        data-bs-toggle="tab"
        data-bs-target="#messages"
        type="button"
        role="tab"
        aria-controls="messages"
        aria-selected="false"
      >Pasos #3</button>
    </li>
  </ul>
  <!-- Tab panes -->
  <div class="card mb-4 border-top-0" style="border-top-left-radius: 0; border-top-right-radius: 0;">
    <div class="card-body">
      <div class="tab-content">
        <div class="tab-pane active" id="business-data" role="tabpanel" tabindex="0">
          @include('afiliados.form.business')
        </div>
        <div class="tab-pane" id="profile" role="tabpanel" tabindex="0">...</div>
        <div class="tab-pane" id="messages" role="tabpanel" tabindex="0">...</div>
      </div>
    </div>
  </div>
</form>
@endsection