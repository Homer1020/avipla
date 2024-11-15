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