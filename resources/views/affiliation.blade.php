@extends('layouts.main')
@section('title', 'Afiliación')
@section('meta_description', 'Únete a la Asociación Venezolana de Plástico y forma parte de nuestra red de empresas y profesionales dedicados al desarrollo y la innovación en la industria del plástico en Venezuela. Descubre los beneficios de ser miembro.')
@section('meta_keywords', 'afiliación, membresía, asociación venezolana de plástico, beneficios de afiliación, industria del plástico, Venezuela, unirse a la asociación')
@section('content')
<div class="header-separator"></div>
<!-- section -->
<section class="section">
  <div class="container-md">
    <div class="row">
      <div class="col-md-6 mb-4 mb-md-0">
        <h1 class="section__title">Afiliación</h1>
        <p>El propósito de AVIPLA es hacer de sus afiliados el motor de desarrollo de la industria plástica nacional.</p>
        <p>AVIPLA ha cumplido la misión para la cual fue creada y ha desarrollado una labor ampliamente conocida, agrupando dentro de sus afiliados a gran parte de la cadena del sector plástico; desde fabricantes y distribuidores de materias primas, distribuidores de maquinaria y equipos, fabricantes y distribuidores transformadores de plástico en todas las modalidades.</p>
        <a href="{{ route('contact') }}" class="btn btn-outline-primary mt-4 me-2">
          <i class="fa fa-pen"></i>
          Afiliate
        </a>
        <a href="{{ route('directory') }}" class="btn btn-primary mt-4">
          <i class="fas fa-address-book"></i>
          Directorio
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
        <h2 class="section__title text-white mb-5 text-center">Beneficios de afiliados</h2>
        <div class="steps d-flex flex-column align-items-center flex-lg-row justify-content-lg-center align-items-lg-baseline">
          <div class="text-center text-lg-end">
            <p class="m-0 fw-bold">Al ser afiliado:</p>
          </div>
          <div class="separador"></div>
          <div>
            <ul class="m-0 list text-center">
              <li>
                Comercio internacional
                <i class="ms-2 fa fa-circle-info"></i>
              </li>
              <li>
                Información
                <i class="ms-2 fa fa-circle-info"></i>
              </li>
              <li>
                Respaldo de intereses
                <i class="ms-2 fa fa-circle-info"></i>
              </li>
              <li>
                Asistencia técnica
                <i class="ms-2 fa fa-circle-info"></i>
              </li>
              <li>
                Formación
                <i class="ms-2 fa fa-circle-info"></i>
              </li>
              <li>
                Asesoría legal
                <i class="ms-2 fa fa-circle-info"></i>
              </li>
            </ul>
          </div>
          <div class="separador"></div>
          <div class="text-center">
            <img src="./assets/img/logowhite.png" alt="" width="100">
          </div>
        </div>

        <div class="text-center" style="margin-top: 4rem">
          <a href="{{ route('contact') }}" class="btn btn-light">
            <i class="fa fa-pen"></i>
            Afiliate
          </a>
        </div>
      </div>
  </div>
</section>
<!-- /section -->

<!-- section -->
<section class="section">
  <div class="container-sm">
    <h2 class="section__title">Proceso de Afiliación</h2>
    
    <div class="row">
      <div class="col-lg-3 mb-5 mb-md-0">
        <div class="afiliation">
          <div class="number">
            <p class="m-0">1</p>
          </div>
          <p class="text-center text-primary fw-bold">Llenar planilla de afiliación anexando los siguientes documentos; RIF y Registro Mercantil</p>
        </div>
      </div>

      <div class="col-lg-3 mb-5 mb-md-0">
        <div class="afiliation">
          <div class="number">
            <p class="m-0">2</p>
          </div>
          <p class="text-center text-primary fw-bold"> Enviar Solicitud, la cual será sometida a consideración por la junta directiva para su debida aprobación</p>
        </div>
      </div>

      <div class="col-lg-3 mb-5 mb-md-0">
        <div class="afiliation">
          <div class="number">
            <p class="m-0">3</p>
          </div>
          <p class="text-center text-primary fw-bold"> Recepción de correo de aprobación, estatutos de la asociación e información de montos a cancelar, cuotas y cuentas bancarias respectivas para proceder con los pagos pertinentes</p>
        </div>
      </div>

      <div class="col-lg-3">
        <div class="number">
          <p class="m-0">4</p>
        </div>
        <p class="text-center text-primary fw-bold"> Recepción correo de bienvenida al gremio, recibos de pago, ingreso al canal de negocios a través de WhatsApp como primer beneficio de afiliación</p>
      </div>
    </div>
  </div>
</section>
<!-- /section -->

<!-- section -->
<section class="section bg-light">
  <div class="container-sm">
    <h2 class="section__title">Recaudos</h2>
    
    <ul class="check-list">
      <li>RIF</li>
      <li>Registro Mercantil</li>
      <li>Plantilla de inscripción <a href="#">Descargar Planilla Aquí</a></li>
    </ul>
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