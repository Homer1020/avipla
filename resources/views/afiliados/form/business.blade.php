<p class="text-muted fw-bold text-uppercase">
    Datos empresa
</p>

<div class="row">
    <div class="col-lg-4">
        <x-forms.input
        name="razon_social"
        id="razon_social"
        placeholder="Empresas Polar"
        label="Razón social"
        :value="old('razon_social', $afiliado->razon_social)"
        :error="$errors->first('razon_social')"
        />
    </div>
    <div class="col-lg-4">
        <x-forms.input
        name="siglas"
        id="siglas"
        placeholder="AVIPLA"
        label="Siglas"
        :value="old('siglas', $afiliado->siglas)"
        :error="$errors->first('siglas')"
        />
    </div>
    <div class="col-lg-4">
        <x-forms.input
        type="url"
        name="pagina_web"
        id="pagina_web"
        label="Página web"
        placeholder="https://avipla.test"
        :value="old('pagina_web', $afiliado->pagina_web)"
        :error="$errors->first('pagina_web')"
        />
    </div>
    </div>


    <div class="row">
    <div class="col-lg-4">
        <x-forms.input
        name="anio_fundacion"
        id="anio_fundacion"
        placeholder="2004"
        label="Año de fundación"
        :value="old('anio_fundacion', $afiliado->anio_fundacion)"
        :error="$errors->first('anio_fundacion')"
        />
    </div>
    <div class="col-lg-4">
        <x-forms.input
        name="capital_social"
        id="capital_social"
        placeholder="0"
        label="Capital Social"
        :value="old('capital_social', $afiliado->capital_social)"
        :error="$errors->first('capital_social')"
        />
    </div>
    <div class="col-lg-4">
        <x-forms.input
        name="rif"
        id="rif"
        placeholder="J-000000001"
        label="RIF"
        :value="old('rif', $afiliado->rif)"
        :error="$errors->first('rif')"
        />
    </div>
</div>


<p class="text-muted fw-bold text-uppercase">
    Direcciones
</p>

<div class="row">
    <div class="col-lg-6">
        <x-forms.textarea
        name="direccion_oficina"
        id="direccion_oficina"
        label="Dirección de oficina"
        :value="old('direccion_oficina', $afiliado->direccion_oficina)"
        :error="$errors->first('direccion_oficina')"
        />
        <x-forms.input
        name="ciudad_oficina"
        id="ciudad_oficina"
        label="Ciudad - Estado (Oficina)"
        :value="old('ciudad_oficina', $afiliado->ciudad_oficina)"
        :error="$errors->first('ciudad_oficina')"
        />
        <x-forms.input
        name="telefono_oficina"
        id="telefono_oficina"
        label="Teléfono (Oficina)"
        :value="old('telefono_oficina', $afiliado->telefono_oficina)"
        :error="$errors->first('telefono_oficina')"
        />
    </div>
    <div class="col-lg-6">
        <x-forms.textarea
        name="direccion_planta"
        id="direccion_planta"
        label="Dirección de planta"
        :value="old('direccion_planta', $afiliado->direccion_planta)"
        :error="$errors->first('direccion_planta')"
        />
        <x-forms.input
        name="ciudad_planta"
        id="ciudad_planta"
        label="Ciudad - Estado (Planta)"
        :value="old('ciudad_planta', $afiliado->ciudad_planta)"
        :error="$errors->first('ciudad_planta')"
        />
        <x-forms.input
        name="telefono_planta"
        id="telefono_planta"
        label="Teléfono (Planta)"
        :value="old('telefono_planta', $afiliado->telefono_planta)"
        :error="$errors->first('telefono_planta')"
        />
    </div>
</div>

<p class="text-muted fw-bold text-uppercase">
    Otros campos
</p>

<div class="row">
    <div class="col-lg-6">
        <x-forms.select
            name="actividad_principal"
            id="actividad_principal"
            label="Actividad principal"
            :value="old('actividad_principal', $afiliado->actividad_principal)"
            :error="$errors->first('actividad_principal')" 
        />
    </div>
    <div class="col-lg-6">
        <x-forms.select
            name="relaciones_comercio_exterior"
            id="relaciones_comercio_exterior"
            label="Relaciones de comercio exterior"
            :value="old('relaciones_comercio_exterior', $afiliado->relaciones_comercio_exterior)"
            :error="$errors->first('relaciones_comercio_exterior')" 
        />
    </div>
</div>