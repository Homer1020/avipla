@extends('layouts.main')
@section('title', 'Servicios')
@section('meta_description', 'Descubre los servicios que ofrece la Asociación Venezolana de Plástico para apoyar a empresas y profesionales en la industria del plástico en Venezuela. Consulta nuestra oferta de servicios especializados y cómo podemos ayudarte.')
@section('meta_keywords', 'servicios, Asociación Venezolana de Plástico, apoyo a empresas, servicios especializados, industria del plástico, Venezuela')
@section('content')
<div class="header-separator"></div>

<!-- section -->
<section class="section">
  <div class="container-md">
    <div class="row">
      <div class="col-md-6 mb-4 mb-md-0">
        <h1 class="section__title">Servicios</h1>
        <p>Ser miembro de AVIPLA significa contar con un respaldo institucional de un gremio que agrupa a las empresas más importantes del Sector Plástico en Venezuela, que además vela por los intereses de todos sus asociados.</p>
        <p>AVIPLA ha cumplido su misión fundacional y ha desarrollado una labor que es conocida tanto a nivel nacional como internacional, convirtiéndola en una de las organizaciones más activas y serias que existen actualmente en el país.</p>
        <p>Para llevar a cabo sus funciones de apoyo a los asociados, cuenta con una sede propia y una estructura organizacional bastante completa que incluye una dirección ejecutiva, una unidad de asistencia técnica y una unidad de información.</p>
        <a href="{{ route('contact') }}" class="btn btn-outline-primary mt-4">
          <i class="fa fa-pen"></i>
          Afiliate
        </a>
      </div>
      <div class="col-md-6">
        <img src="./assets/img/chip.jpg" alt="Chip" class="img-fluid rounded">
      </div>
    </div>
  </div>
</section>
<!-- /section -->

<!-- section -->
<section class="section bg-secondary text-white">
  <div class="container-sm">
    <div class="row align-items-center">
      <div class="col-md-12">
        <h2 class="section__title text-white mb-5 text-center">Servicios a afiliados</h2>
        <div class="steps d-flex flex-column align-items-center flex-lg-row justify-content-lg-center align-items-lg-baseline mb-5 mb-lg-4">
          <div class="text-center text-lg-end">
            <p class="m-0 fw-bold">Si eres:</p>
          </div>
          <div class="separador"></div>
          <div>
            <ul class="m-0 list text-center">
              <li>
                Miembro activo
                <i class="ms-2 fa fa-circle-info"></i>
              </li>
              <li>
                Miembro asociado
                <i class="ms-2 fa fa-circle-info"></i>
              </li>
              <li>
                Miembro honorario
                <i class="ms-2 fa fa-circle-info"></i>
              </li>
            </ul>
          </div>
          <div class="separador"></div>
          <div>
            <a href="#" class="btn btn-light">
              <i class="fa fa-pen"></i>
              Asociate
            </a>
          </div>
        </div>

        <div class="steps d-flex flex-column align-items-center flex-lg-row justify-content-lg-center align-items-lg-baseline">
          <div class="text-center text-lg-end">
            <p class="m-0 fw-bold">Y ten acceso a:</p>
          </div>
          <div class="separador"></div>
          <div>
            <ul class="m-0 list text-center">
              <li>
                Representación
                <i class="ms-2 fa fa-circle-info"></i>
              </li>
              <li>
                Atención permanente
                <i class="ms-2 fa fa-circle-info"></i>
              </li>
              <li>
                Capacitación
                <i class="ms-2 fa fa-circle-info"></i>
              </li>
              <li>
                Promoción
                <i class="ms-2 fa fa-circle-info"></i>
              </li>
              <li>
                Información
                <i class="ms-2 fa fa-circle-info"></i>
              </li>
              <li>
                Asesoramiento
                <i class="ms-2 fa fa-circle-info"></i>
              </li>
            </ul>
          </div>
          <div class="separador"></div>
          <div class="text-center">
            <img src="./assets/img/logowhite.png" alt="" width="150">
          </div>
        </div>

        <div class="text-center" style="margin-top: 4rem">
          <a href="#" class="btn btn-light">
            Saber más
          </a>
        </div>
      </div>
  </div>
</section>
<!-- /section -->

<!-- section -->
<section class="section">
  <div class="container-sm">
      <h2 class="section__title">Organismos y representaciones</h2>
      <div class="row align-items-center">
        @foreach ($organismos as $organismo)
            <div class="col-md-3 mb-5 mb-md-0 text-center">
                <img src="{{ Storage::url($organismo->logotipo) }}" alt="Logo {{ $organismo->razon_social }}" class="img-fluid" width="150">
            </div>
        @endforeach
      </div>
  </div>
</section>
<!-- /section -->
@endsection