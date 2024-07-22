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
            'brand'                             => 'nullable|max:2024|image',
            'rif_path'                          => 'nullable|max:2024|mimes:pdf',
            'registro_mercantil_path'           => 'nullable|max:2024|mimes:pdf',
            'estado_financiero_path'            => 'nullable|max:2024|mimes:pdf',
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
            'numero_encargado_ws'               => 'nullable|numeric',

            'productos'                         => 'required|array|min:1',
            'productos.*'                       => 'required',
            'produccion_total_mensual'          => 'array',
            'produccion_total_mensual.*'        => 'required',
            'porcentage_exportacion'            => 'array', 
            'porcentage_exportacion.*'          => 'required', 
            'mercado_exportacion'               => 'array',
            'mercado_exportacion.*'             => 'required',
            
            'materias_primas'                   => 'required|array|min:1',
            'materias_primas.*'                 => 'required',
            'servicios'                         => 'required|array|min:1',
            'servicios.*'                       => 'required',
            'afiliados'                         => 'array',
            'afiliados.*'                       => 'exists:afiliados,id',
        ];
    }

    public function attributes() {
        return [    
            'brand'                             => 'logo',
            'anio_fundacion'                    => 'año de fundación',
            'direccion_oficina'                 => 'dirección oficina',
            'direccion_planta'                  => 'dirección de planta',
            'direccion_oficina'                 => 'dirección de oficina',
            'telefono_oficina'                  => 'teléfono de oficina',
            'telefono_planta'                   => 'teléfono de planta',
            'rif_path'                          => 'documento rif',
            'registro_mercantil_path'           => 'documento registro mercantil',
            'estado_financiero_path'            => 'documento estado financiero',
            'correo_presidente'                 => 'correo del presidente',
            'correo_gerente_general'            => 'correo del gerente general',
            'correo_gerente_compras'            => 'correo del gerente de compras',
            'correo_gerente_marketing_ventas'   => 'correo del gerente de marketing y ventas',
            'correo_gerente_planta'             => 'correo del gerente de planta',
            'correo_gerente_recursos_humanos'   => 'correo del gerente de recursos humanos',
            'correo_administrador'              => 'correo del administrador',
            'correo_gerente_exportaciones'      => 'correo del gerente de exportaciones',
            'correo_representante_avipla'       => 'correo del representante ante AVIPLA',
            'numero_encargado_ws'               => 'teléfono del encargado de whatsapp',
            'servicios'                         => 'servicios prestados',
        ];
    }

    public function messages() {
        return [
            'actividad_id.required'         => 'La actividad principal es requerida',
            'productos.required'            => 'La línea de productos es requerida',
            'produccion_total_mensual.*'    => 'la producción total mensual es obligatoria',
            'porcentage_exportacion.*'      => 'el porcentage de exportación es obligatoria',
            'mercado_exportacion.*'         => 'el mercado de exportación es obligatoria'
        ];
    }
}
