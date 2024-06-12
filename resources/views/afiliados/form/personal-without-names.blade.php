<p class="fw-bold text-uppercase text-muted">Actividades</p>
<div class="row">
  <div class="col-lg-6">
    <x-forms.select name="actividad_principal" id="actividad_principal" label="Actividad principal"
      :value="old('actividad_principal', $afiliado->actividad_principal)"
      :error="$errors->first('actividad_principal')">
      <option selected disabled>Seleccione una actividad</option>
      @foreach ($actividades as $actividad)
      <option value="{{ $actividad->id }}">{{ $actividad->actividad }}</option>
      @endforeach
    </x-forms.select>
  </div>
  <div class="col-lg-6">
    <x-forms.select name="relaciones_comercio_exterior" id="relaciones_comercio_exterior"
      label="Relaciones de comercio exterior"
      :value="old('relaciones_comercio_exterior', $afiliado->relaciones_comercio_exterior)"
      :error="$errors->first('relaciones_comercio_exterior')">
      <option disabled selected>Seleccione una relación</option>
      <option value="IMPORTADOR">IMPORTADOR</option>
      <option value="EXPORTADOR">EXPORTADOR</option>
      <option value="AMBOS">AMBOS</option>
    </x-forms.select>
  </div>
</div>

<p class="fw-bold text-uppercase text-muted">Datos del personal</p>

<div class="row">
  <div class="col-lg-6">
    <x-forms.input name="correo_presidente" id="correo_presidente" placeholder="Correo del Presidente"
      label="Correo del Presidente" :value="old('correo_presidente', $afiliado->correo_presidente)"
      :error="$errors->first('correo_presidente')" />
  </div>
  <div class="col-lg-6">
    <x-forms.input name="correo_gerente_general" id="correo_gerente_general" placeholder="Correo del Gerente General"
      label="Correo del Gerente General" :value="old('correo_gerente_general', $afiliado->correo_gerente_general)"
      :error="$errors->first('correo_gerente_general')" />
  </div>
  <div class="col-lg-6">
    <x-forms.input name="correo_gerente_compras" id="correo_gerente_compras" placeholder="Correo del Gerente de Compras"
      label="Correo del Gerente de Compras" :value="old('correo_gerente_compras', $afiliado->correo_gerente_compras)"
      :error="$errors->first('correo_gerente_compras')" />
  </div>

  <div class="col-lg-6">
    <x-forms.input name="correo_gerente_marketing_ventas" id="correo_gerente_marketing_ventas"
      placeholder="Correo del Gerente de Marketing y Ventas" label="Correo del Gerente de Marketing y Ventas"
      :value="old('correo_gerente_marketing_ventas', $afiliado->correo_gerente_marketing_ventas)"
      :error="$errors->first('correo_gerente_marketing_ventas')" />
  </div>
  <div class="col-lg-6">
    <x-forms.input name="correo_gerente_planta" id="correo_gerente_planta" placeholder="Correo del Gerente de Planta"
      label="Correo del Gerente de Planta" :value="old('correo_gerente_planta', $afiliado->correo_gerente_planta)"
      :error="$errors->first('correo_gerente_planta')" />
  </div>

  <div class="col-lg-6">
    <x-forms.input name="correo_gerente_recursos_humanos" id="correo_gerente_recursos_humanos"
      placeholder="Correo del Gerente de Recursos Humanos" label="Correo del Gerente de Recursos Humanos"
      :value="old('correo_gerente_recursos_humanos', $afiliado->correo_gerente_recursos_humanos)"
      :error="$errors->first('correo_gerente_recursos_humanos')" />
  </div>
  <div class="col-lg-6">
    <x-forms.input name="correo_administrador" id="correo_administrador" placeholder="Correo del Administrador"
      label="Correo del Administrador" :value="old('correo_administrador', $afiliado->correo_administrador)"
      :error="$errors->first('correo_administrador')" />
  </div>

  <div class="col-lg-6">
    <x-forms.input name="correo_gerente_exportaciones" id="correo_gerente_exportaciones"
      placeholder="Correo del Gerente de Exportaciones" label="Correo del Gerente de Exportaciones"
      :value="old('correo_gerente_exportaciones', $afiliado->correo_gerente_exportaciones)"
      :error="$errors->first('correo_gerente_exportaciones')" />
  </div>
  <div class="col-lg-6">
    <x-forms.input name="correo_representante_avipla" id="correo_representante_avipla"
      placeholder="Correo del Representante de AVIPLA" label="Correo del Representante de AVIPLA"
      :value="old('correo_representante_avipla', $afiliado->correo_representante_avipla)"
      :error="$errors->first('correo_representante_avipla')" />
  </div>
</div>