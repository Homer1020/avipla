<p class="fw-bold text-uppercase">
    Datos empresa
</p>

<div class="row">
    <div class="col-lg-4">
        <x-forms.input
            name="razon_social"
            id="razon_social"
            placeholder="Empresas Polar"
            label="Razón social"
            required
            :value="old('razon_social', $afiliado->razon_social ? $afiliado->razon_social : $solicitud->razon_social)"
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
            type="number"
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
            type="number"
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
            required
            label="RIF"
            :value="old('rif', $afiliado->rif)"
            :error="$errors->first('rif')"
        />
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <x-forms.input
            type="file"
            name="brand"
            id="brand"
            label="Logotipo de la empresa"
            :error="$errors->first('brand')"
            accept="image/*"
        />
        @if ($afiliado->brand)
            <div class="text-center">
                <img width="200" class="mb-3" src="{{ Storage::url($afiliado->brand) }}" alt="Logo: {{ $afiliado->razon_social }}">
            </div>
        @endif
    </div>
</div>

<p class="fw-bold text-uppercase">
    Direcciones
</p>

<div class="row">
    <div class="col-lg-6">
        <x-forms.textarea
            name="direccion_oficina"
            id="direccion_oficina"
            label="Dirección de oficina"
            placeholder="Ingrese una dirección"
            :value="old('direccion_oficina', $afiliado->direccion ? $afiliado->direccion->direccion_oficina : '')"
            :error="$errors->first('direccion_oficina')"
        />
        <x-forms.input
            name="ciudad_oficina"
            id="ciudad_oficina"
            label="Ciudad - Estado (Oficina)"
            placeholder="Ingrese una ciudad o estado"
            :value="old('ciudad_oficina', $afiliado->direccion ? $afiliado->direccion->ciudad_oficina : '')"
            :error="$errors->first('ciudad_oficina')"
        />
        <x-forms.input
            type="tel"
            name="telefono_oficina"
            id="telefono_oficina"
            label="Teléfono (Oficina)"
            placeholder="Ingrese un teléfono"
            :value="old('telefono_oficina', $afiliado->direccion ? $afiliado->direccion->telefono_oficina : '')"
            :error="$errors->first('telefono_oficina')"
        />
    </div>
    <div class="col-lg-6">
        <x-forms.textarea
            name="direccion_planta"
            id="direccion_planta"
            label="Dirección de planta"
            placeholder="Ingrese una dirección"
            :value="old('direccion_planta', $afiliado->direccion ? $afiliado->direccion->direccion_planta : '')"
            :error="$errors->first('direccion_planta')"
        />
        <x-forms.input
            name="ciudad_planta"
            id="ciudad_planta"
            label="Ciudad - Estado (Planta)"
            placeholder="Ingrese una ciudad o estado"
            :value="old('ciudad_planta', $afiliado->direccion ? $afiliado->direccion->ciudad_planta : '')"
            :error="$errors->first('ciudad_planta')"
        />
        <x-forms.input
            name="telefono_planta"
            id="telefono_planta"
            label="Teléfono (Planta)"
            placeholder="Ingrese un teléfono"
            type="tel"
            :value="old('telefono_planta', $afiliado->direccion ? $afiliado->direccion->telefono_planta : '')"
            :error="$errors->first('telefono_planta')"
        />
    </div>
</div>

<p class="fw-bold text-uppercase">
    Documentos
</p>

<div class="row">
    <div class="col-md-4 col-lg-4">
        <x-forms.input
            type="file"
            name="rif_path"
            id="rif_path"
            label="RIF"
            :error="$errors->first('rif_path')"
            accept="application/pdf"
        />
    </div>
    <div class="col-md-4 col-lg-4">
        <x-forms.input
            type="file"
            name="registro_mercantil_path"
            id="registro_mercantil_path"
            label="Registro mercantil"
            :error="$errors->first('registro_mercantil_path')"
            accept="application/pdf"
        />
    </div>
    <div class="col-md-4 col-lg-4">
        <x-forms.input
            type="file"
            name="estado_financiero_path"
            id="estado_financiero_path"
            label="Estado financiero"
            :error="$errors->first('estado_financiero_path')"
            accept="application/pdf"
        />
    </div>
</div>