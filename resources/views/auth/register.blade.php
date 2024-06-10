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
  <!-- CUSTOM CSS -->
  <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">
  <!-- OWL CAROUSEL -->
  <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">
  <!-- OWL CAROUSEL THEME -->
  <link rel="stylesheet" href="{{ asset('assets/css/owl.theme.default.css') }}">
</head>

<body class="bg-secondary">
  <main class="auth-layout">
    <div class="container my-3">
      <div class="row justify-content-center">
        <div class="col-lg-10">
          <div class="card shadow">
            <div class="card-body p-4">
              <h1 class="fs-3 text-center text-primary mb-4">Crear cuenta</h1>

              <form action="{{ route('auth.register') }}" method="POST">
                @csrf

                <input type="hidden" name="confirmation_code" value="{{ $afiliado->confirmation_code }}">

                <div class="row">
                  <div class="col-lg-4">
                    <!-- name -->
                    <x-forms.input
                      placeholder="John Doe"
                      name="name"
                      id="name"
                      label="Nombre del encargado:"
                      :error="$errors->first('razon_social')"
                      :autofocus="true"
                    />
                    <!-- /name -->
                  </div>
                  <div class="col-lg-4">
                    <!-- razon_social -->
                    <x-forms.input
                      placeholder="Empresas polar"
                      name="razon_social"
                      id="razon_social"
                      label="Razón social:"
                      :value="$afiliado->razon_social"
                      :error="$errors->first('razon_social')"
                    />
                    <!-- /razon_social -->
                  </div>
                  <div class="col-lg-4">
                    <!-- rif -->
                    <x-forms.input
                      placeholder="J-000000001"
                      name="rif"
                      id="rif"
                      label="RIF:"
                      :error="$errors->first('rif')"
                      :value="$afiliado->rif"
                    />
                    <!-- /rif -->
                  </div>
                </div>

                <div class="row">
                  <div class="col-lg-6">
                    <!-- correo -->
                    <x-forms.input
                      type="email"
                      placeholder="johndoe@gmail.com"
                      name="email"
                      id="email"
                      label="Correo del encargado:"
                      :value="$afiliado->correo"
                      :error="$errors->first('email')"
                    />
                    <!-- /correo -->
                  </div>
                  <div class="col-lg-6">
                    <!-- correo -->
                    <x-forms.input
                      type="url"
                      placeholder="https://empresas.polar.com"
                      name="pagina_web"
                      id="pagina_web"
                      label="Página web:"
                      :error="$errors->first('pagina_web')"
                    />
                    <!-- /correo -->
                  </div>
                </div>

                <!-- password -->
                <x-forms.input
                  type="password"
                  placeholder="********"
                  name="password"
                  id="password"
                  label="Contraseña:"
                  :error="$errors->first('password')"
                />
                <!-- /password -->

                <!-- password -->
                <x-forms.input
                  type="password"
                  placeholder="********"
                  name="password_confirmation"
                  id="password_confirmation"
                  label="Confirmar contraseña:"
                />
                <!-- /password -->

                <div class="d-flex align-items-center mt-5">
                  <input type="submit" value="Registrar" class="btn btn-primary me-4">
                  <a href="{{ route('auth.loginForm') }}">Iniciar sesion</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

  <!-- BOOTSTRAP -->
  <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <!-- OWL CAROUSEL -->
  <script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
  <!-- SCRIPT -->
  <script src="{{ asset('assets/js/app.js') }}"></script>
</body>

</html>