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
            'siglas'                            => 'nullable|string',
            'pagina_web'                        => 'nullable',
            'anio_fundacion'                    => 'nullable|unique:afiliados,rif',
            'capital_social'                    => 'nullable|numeric|min:0',
            'rif'                               => 'required|unique:afiliados,rif,' . $afiliado->id,
            'direccion_oficina'                 => 'nullable|string',
            'ciudad_oficina'                    => 'nullable|string',
            'telefono_oficina'                  => 'nullable|numeric',
            'direccion_planta'                  => 'nullable|string',
            'ciudad_planta'                     => 'nullable|string',
            'telefono_planta'                   => 'nullable|numeric',
            'actividad_id'                      => 'nullable|numeric|exists:actividades,id',
            'relaciones_comercio_exterior'      => 'nullable|string|in:IMPORTADOR,EXPORTADOR,AMBOS',
            'relaciones_comercio_exterior'      => 'nullable|string|in:IMPORTADOR,EXPORTADOR,AMBOS',
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
            'productos'                         => 'nullable|array',
            'productos.*'                       => 'required',
            'produccion_total_mensual'          => 'array',
            'produccion_total_mensual.*'        => 'required',
            'porcentage_exportacion'            => 'array', 
            'porcentage_exportacion.*'          => 'required', 
            'mercado_exportacion'               => 'array',
            'mercado_exportacion.*'             => 'required',
            'materias_primas'                   => 'nullable|array',
            'materias_primas.*'                 => 'required',
            'servicios'                         => 'nullable|array',
            'servicios.*'                       => 'required',
            'afiliados'                         => 'nullable|array',
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
