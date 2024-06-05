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
        <div class="col-lg-5 bg-auth rounded" style="background-image: url({{ asset('assets/img/robot.jpg') }})">
        </div>
        <div class="col-lg-5">
          <div class="card shadow">
            <div class="card-body p-5">
              <h1 class="fs-3 text-center text-primary mb-4">Crear cuenta</h1>

              <form action="{{ route('auth.register') }}" method="POST">
                @csrf

                <!-- razon_social -->
                <div class="mb-3">
                  <label for="razon_social" class="form-label">Razón social:</label>
                  <input
                    type="razon_social"
                    class="form-control"
                    placeholder="Empresas polar"
                    name="razon_social"
                    id="razon_social"
                    value="{{ $afiliado->razon_social }}"
                    {{ $afiliado->id ? 'disabled' : '' }}
                  >
                </div>
                <!-- /razon_social -->

                <!-- correo -->
                <div class="mb-3">
                  <label for="email" class="form-label">Correo:</label>
                  <input
                    type="email"
                    class="form-control"
                    placeholder="johndoe@gmail.com"
                    name="email"
                    id="email"
                  >
                </div>
                <!-- /correo -->

                <!-- password -->
                <div class="mb-3">
                  <label for="password" class="form-label">Contrasena:</label>
                  <input
                    type="password"
                    class="form-control"
                    placeholder="********"
                    name="password"
                    id="password"
                  >
                </div>
                <!-- /password -->

                <!-- password -->
                <div class="mb-3">
                  <label for="password-confirm" class="form-label">Confirmar contraseña:</label>
                  <input
                    type="password-confirm"
                    class="form-control"
                    placeholder="********"
                    name="password-confirm"
                    id="password-confirm"
                  >
                </div>
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