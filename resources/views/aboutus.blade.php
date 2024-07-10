@extends('layouts.main')
@section('title', '¿Quienes somos?')
@section('content')
<div class="header-separator"></div>

<!-- section -->
<section class="section">
  <div class="container-md">
      <div class="row">
      <h1 class="section__title">¿Quienes somos?</h1>
      <div class="col-lg-6">
        <p>AVIPLA (Asociación Venezolana de Industrias Plásticas) fue fundada el 22 de octubre de 1965 como una asociación representativa que reúne a las empresas del Sector plástico, con el fin de promover e impulsar el desarrollo de la industria plástica a Nivel Nacional.</p>
        <p> La asociación se dedica a fortalecer la unión del sector industrial que representa, defender los intereses y buscar soluciones prácticas para sus afiliados, dentro del ámbito legal, a través de comités y grupos de trabajo integrados por la propia asociación.</p>
        <p> A nivel Nacional AVIPLA fomenta relaciones con todas aquellas organizaciones representativas de la producción nacional, cuya cooperación beneficie los movimientos industriales del País, ya sean económicos, comerciales o relacionados con la sustentabilidad.</p>
        <p> AVIPLA colabora con el Ejecutivo nacional con todas las iniciativas que previo estudio, propicie el desarrollo del sector industrial y continúa trabajando para participar en las decisiones que afectan a nuestra industria, para informar, educar y promover la producción sostenible de los productos plásticos manufacturados en el País, procurando su continuo mejoramiento.</p>
      </div>
      <div class="col-lg-6 position-relative">
          <div class="figure-reciclaje mt-5 mt-lg-0">
              <img src="./assets/img/reciclaje.jpg" alt="Reciclaje" class="img-fluid shadow-sm">
              <img src="./assets/img/reciclaje2.jpg" alt="Reciclaje" class="img-fluid shadow-sm">
              <img src="./assets/img/flor.jpg" alt="Reciclaje" class="img-fluid shadow-sm">
              <img src="./assets/img/reciclaje3.jpg" alt="Reciclaje" class="img-fluid shadow-sm">
          </div>
      </div>
      </div>
  </div>
  </section>
  <!-- /section --> 

  <!-- section -->
  <section class="section section--with-decoration bg-secondary text-white">
      <div class="container-sm">
          <div class="row align-items-center">
              <div class="col-md-6">
                  <h2 class="section__title text-white mb-4">Misión</h2>
                  <p class="mb-4">Promover el desarrollo y crecimiento del sector plástico a nivel global y estimular su competitividad, avance tecnológico y responsabilidad social, con miras a mejorar la calidad de vida del venezolano, al hacer uso racional y ecológico de los productos plásticos.</p>
                  <h2 class="section__title text-white mb-4">Visión</h2>
                  <p class="mb-0">Ser reconocida como la asociación representativa de la industria del plástico en Venezuela por su contribución al desarrollo y fortalecimiento del sector transformador.</p>
              </div>
              <div class="col-md-6">
              </div>
          </div>
      </div>
  </section>
  <!-- /section -->

  <!-- section -->
  <section class="section">
      <div class="container-sm">
          <div class="row align-items-center">
              <div class="col-md-6 mb-4 mb-md-0">
                  <img src="./assets/img/handshake.jpg" alt="Botellas" class="rounded img-fluid h-100 object-fit-cover shadow-sm">
              </div>
              <div class="col-md-6">
                  <h2 class="fs-5 fw-bold">AVIPLA está afiliada a CONINDUSTRIA como muestra de su articulación a la cadena gremial y mantiene relaciones activas con sus instituciones homólogas en América Latina, Europa y Asia.</h2>
              </div>
          </div>
      </div>
  </section>
  <!-- /section -->

  <!-- section -->
  <section class="section section--with-decoration-under bg-secondary text-white">
      <div class="container-sm">
          <div class="row align-items-center">
            <h2 class="section__title text-white mb-5">Junta directiva {{ date('Y') }}</h2>
            <div class="row">
              <div class="col-xl-10">
                <div class="col-lg-6">
                  <div class="row align-items-center mb-4">
                    <div class="col-6">
                      <h3 class="fs-6 mb-0 fw-bold text-end">Presidente</h3>
                    </div>
                    <div class="col-6">
                      {{-- @dump($juntaDirectivaPersonal->toArray()) --}}
                      <p class="mb-0">
                        @php
                          $persona = $juntaDirectivaPersonal->first(function ($item) {
                            return $item['role']['display_name'] === 'Presidente';
                          });
                          if ($persona) {
                            echo $persona->nombre;
                          }
                        @endphp
                      </p>
                    </div>
                  </div>
                  <div class="row align-items-center mb-4">
                    <div class="col-6">
                        <h3 class="fs-6 mb-0 fw-bold text-end">Vice presidente</h3>
                    </div>
                    <div class="col-6">
                      <p class="mb-0">
                        @php
                          $persona = $juntaDirectivaPersonal->first(function ($item) {
                            return $item['role']['display_name'] === 'Vice presidente';
                          });
                          if ($persona) {
                            echo $persona->nombre;
                          }
                        @endphp
                      </p>
                    </div>
                  </div>
                  <div class="row align-items-center mb-4">
                    <div class="col-6">
                        <h3 class="fs-6 mb-0 fw-bold text-end">Tesorero</h3>
                    </div>
                    <div class="col-6">
                        <p class="mb-0">
                          @php
                            $persona = $juntaDirectivaPersonal->first(function ($item) {
                              return $item['role']['display_name'] === 'Tesorero';
                            });
                            if ($persona) {
                              echo $persona->nombre;
                            }
                          @endphp
                        </p>
                    </div>
                  </div>
                </div>
                <div class="col-12">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="row align-items-start mb-4">
                        <div class="col-6">
                            <h3 class="fs-6 mb-0 fw-bold text-end">Directores principales</h3>
                        </div>
                        <div class="col-6">
                            @foreach ($directoresPrincipales as $director)
                              <p class="mb-2">{{ $director->nombre }}</p>
                            @endforeach
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="row align-items-start mb-4">
                        <div class="col-6">
                            <h3 class="fs-6 mb-0 fw-bold text-end">Directores secundarios</h3>
                        </div>
                        <div class="col-6">
                          @foreach ($directoresSecundarios as $director)
                            <p class="mb-2">{{ $director->nombre }}</p>
                          @endforeach
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="row align-items-center mb-4">
                    <div class="col-6">
                        <h3 class="fs-6 mb-0 fw-bold text-end">Director ejecutivo</h3>
                    </div>
                    <div class="col-6">
                        <p class="mb-0">
                          @php
                            $persona = $juntaDirectivaPersonal->first(function ($item) {
                              return $item['role']['display_name'] === 'Director ejecutivo';
                            });
                            if ($persona) {
                              echo $persona->nombre;
                            }
                          @endphp
                        </p>
                    </div>
                  </div>
                </div>
              </div>
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