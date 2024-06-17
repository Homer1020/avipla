<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>AVIPLA | Registro</title>
  <!-- BOOTSTRAP -->
  <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
  <!-- FONT AWESOME -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
  <!-- OWL CAROUSEL -->
  <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">
  <!-- OWL CAROUSEL THEME -->
  <link rel="stylesheet" href="{{ asset('assets/css/owl.theme.default.css') }}">
  <!-- SELECT2 -->
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <!-- SELECT2 BOOTSTRAP THEME -->
  <link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
  <!-- CUSTOM CSS -->
  <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">
</head>

<body class="bg-secondary">
  <main class="auth-layout">
    <div class="container my-5">
      <div class="row justify-content-center">
        <div class="col-lg-11">
          <div class="card shadow">
            <div class="card-body p-4">
              <div class="text-center mb-4">
                <img src="{{ asset('assets/img/logo.png') }}" alt="Logo AVIPLA" width="100px">
              </div>
              <h1 class="fs-3 fw-bold text-primary text-center mb-4 text-uppercase">Crear cuenta</h1>

              <form novalidate action="{{ route('auth.register') }}" method="POST">
                @csrf
                <input type="hidden" name="confirmation_code" value="{{ $solicitud->confirmation_code }}">
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
                  <li class="nav-item" role="presentation">
                    <button class="nav-link" id="final-tab" data-bs-toggle="tab" data-bs-target="#final"
                      type="button" role="tab" aria-controls="final" aria-selected="false">Registro de encargado</button>
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
                  <div class="tab-pane" id="final" role="tabpanel" tabindex="0">
                    <p class="fw-bold text-muted text-uppercase">Datos del encargado</p>
                    <div class="row">
                      <div class="col-lg-6">
                        <!-- name -->
                        <x-forms.input
                          placeholder="John Doe"
                          name="name"
                          id="name"
                          label="Nombre del encargado:"
                          :value="old('name')"
                          :error="$errors->first('name')" :autofocus="true" />
                        <!-- /name -->
                      </div>
                      <div class="col-lg-6">
                        <!-- correo -->
                        <x-forms.input
                          type="email"
                          placeholder="johndoe@gmail.com"
                          name="email"
                          id="email"
                          label="Correo del encargado:"
                          :value="old('email', $solicitud->correo)"
                          :error="$errors->first('email')"
                        />
                        <!-- /correo -->
                      </div>
                    </div>

                    <!-- password -->
                    <x-forms.input type="password" placeholder="********" name="password" id="password"
                      label="Contraseña:" :error="$errors->first('password')" />
                    <!-- /password -->

                    <!-- password -->
                    <x-forms.input type="password" placeholder="********" name="password_confirmation"
                      id="password_confirmation" label="Confirmar contraseña:" />
                    <!-- /password -->

                    <div class="d-flex align-items-center mt-5">
                      <input type="submit" value="Registrar" class="btn btn-primary me-4">
                      <a href="{{ route('auth.loginForm') }}">Iniciar sesion</a>
                    </div>
                  </div>
                </div>
              </form>
            </div>
            <div class="card-footer p-4">
              <p class="text-muted m-0 text-center">© 2024 AVIPLA. Todos los derechos reservados.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

  <!-- BOOTSTRAP -->
  <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <!-- OWL CAROUSEL -->
  <script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
  <!-- SCRIPT -->
  <script src="{{ asset('assets/js/app.js') }}"></script>
  <!-- SELECT2 -->
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <!-- CUSTOM SCRIPT -->
  <script>
    $(document).ready(function () {
      $('#actividad_principal').select2({
        theme: 'bootstrap-5',
        tags: true,
      })

      $('#productos').select2({
        theme: 'bootstrap-5',
        tags: true,
      })

      $('#materias_primas').select2({
        theme: 'bootstrap-5',
        tags: true,
      })

      $('#servicios').select2({
        theme: 'bootstrap-5',
        tags: true,
      })

      $('#afiliados').select2({
        theme: 'bootstrap-5'
      })

      $('#productos').on('select2:select', function (e) {
        const parameter = e.params.data.text

        const newInputProduccionTotalMensual = `
          <div class="row" id="producto-${parameter.toLowerCase().trim().replace(' ', '-')}">
            <div class="col-12">
              <p class="fw-bold text-uppercase text-muted">
                <small>Detalles de ${parameter}</small>
              </p>
            </div>
            <div class="col-lg-4 mb-3">
              <input
                type="number"
                placeholder="Producción total mensual (TM)"
                name="produccion_total_mensual[]"
                class="form-control"
              />
            </div>
            <div class="col-lg-4 mb-3">
              <input
                type="number"
                placeholder=" Porcentaje destinados a exportación"
                name="porcentage_exportacion[]"
                class="form-control"
              />
            </div>
            <div class="col-lg-4 mb-3">
              <input
                type="number"
                placeholder="Mercados de importación / exportación"
                name="mercado_exportacion[]"
                class="form-control"
              />
            </div>
          </div>
        `.trim()

        $('#products_details').append(newInputProduccionTotalMensual)
      })

      $('#productos').on('select2:unselect', function (e) {
        const parameter = e.params.data.text
        console.log(parameter.toLowerCase().trim().replace(' ', '-'))
        $(`#producto-${parameter.toLowerCase().trim().replace(' ', '-')}`).remove()
      });
    })
  </script>
</body>

</html>