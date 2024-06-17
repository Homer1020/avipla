<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAfiliadoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $afiliado = $this->route('afiliado');
        return [
            'razon_social'                      => 'required|string',
            'siglas'                            => 'required|string',
            'pagina_web'                        => 'url|nullable',
            'anio_fundacion'                    => 'required|unique:afiliados,rif',
            'capital_social'                    => 'required|numeric|min:0',
            'rif'                               => 'required|unique:afiliados,rif,' . $afiliado->id,
            'direccion_oficina'                 => 'required|string',
            'ciudad_oficina'                    => 'required|string',
            'telefono_oficina'                  => 'required|numeric',
            'direccion_planta'                  => 'required|string',
            'ciudad_planta'                     => 'required|string',
            'telefono_planta'                   => 'required|numeric',
            'actividad_id'                      => 'required|numeric|exists:actividades,id',
            'relaciones_comercio_exterior'      => 'required|string|in:IMPORTADOR,EXPORTADOR,AMBOS',
            'relaciones_comercio_exterior'      => 'required|string|in:IMPORTADOR,EXPORTADOR,AMBOS',
            'correo_presidente'                 => 'nullable|email',
            'correo_gerente_general'            => 'nullable|email',
            'correo_gerente_compras'            => 'nullable|email',
            'correo_gerente_marketing_ventas'   => 'nullable|email',
            'correo_gerente_planta'             => 'nullable|email',
            'correo_gerente_recursos_humanos'   => 'nullable|email',
            'correo_administrador'              => 'nullable|email',
            'correo_gerente_exportaciones'      => 'nullable|email',
            'correo_representante_avipla'       => 'nullable|email',

            'productos'                         => 'required|array|min:1',
            'productos.*'                       => 'required|exists:productos,id',
            'produccion_total_mensual'          => 'array',
            'produccion_total_mensual.*'        => 'required',
            'porcentage_exportacion'            => 'array', 
            'porcentage_exportacion.*'          => 'required', 
            'mercado_exportacion'               => 'array',
            'mercado_exportacion.*'             => 'required',
            
            'materias_primas'                   => 'required|array|min:1',
            'materias_primas.*'                 => 'required|exists:productos,id',
            'servicios'                         => 'required|array|min:1',
            'servicios.*'                       => 'required|exists:servicios,id',
            'afiliados'                         => 'array',
            'afiliados.*'                       => 'exists:afiliados,id',
        ];
    }
}
