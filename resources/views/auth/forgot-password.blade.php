<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>AVIPLA | Recuperar contraseña</title>
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
        <div class="col-lg-5">
          <div class="card shadow">
            <div class="card-body p-5">
              <div class="text-center mb-4">
                <img src="{{ asset('assets/img/logo.png') }}" alt="Logo AVIPLA" width="100px">
              </div>

              <h1 class="fs-3 text-center text-primary mb-4">Recuperar contraseña</h1>

              <form action="{{ route('password.email') }}" method="POST">
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

                <input type="submit" value="Enviar correo de recuperación" class="btn btn-primary text-center w-100">
              </form>
            </div>
            <div class="card-footer py-4">
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
  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <!-- OWL CAROUSEL -->
  <script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
  <!-- SWEET ALERT -->
  <!-- SCRIPT -->
  <script src="{{ asset('assets/js/app.js') }}"></script>
  @if (session('success'))
    <script>
      Swal.fire({
        icon: "success",
        title: "{{ session('success') }}"
      });
    </script>
  @endif
</body>

</html>