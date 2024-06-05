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
              <img src="{{ asset('assets/img/avatar.webp') }}" alt="Avatar" width="100" class="d-block mx-auto mb-3">

              <h1 class="fs-3 text-center text-primary mb-4">Iniciar sesión</h1>

              <form action="{{ route('auth.login') }}" method="POST">
                @csrf

                <!-- correo -->
                <div class="form-floating mb-3">
                  <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="johndoe@gmail.com">
                  <label for="email">Correo electrónico</label>
                  @error('email')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
                <!-- /correo -->

                <!-- correo -->
                <div class="form-floating mb-3">
                  <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="*******">
                  <label for="password">Contraseña</label>
                  @error('password')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
                <!-- /correo -->

                <div class="d-flex align-items-center mt-5">
                  <input type="submit" value="Iniciar sesión" class="btn btn-primary me-4">
                  <a href="{{ route('auth.registerForm') }}">Crear cuenta</a>
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