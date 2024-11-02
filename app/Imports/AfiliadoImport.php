<?php

namespace App\Imports;

use App\Models\Afiliado;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AfiliadoImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $afiliado = new Afiliado([
            'razon_social'                  => $row['empresa_afiliada'],
            'rif'                           => $row['rif'],
            'anio_fundacion'                => $row['ano_de_fundacion'],
            // 'capital_social'                => $row['capital_social'],
            // 'pagina_web'                    => $row['pagina_web'],
            'actividad_id'                  => $row['actividad_principal'],
            'relacion_comercio_exterior'    => $row['relacion_comercio_exterior'] ?? 'EXPORTADOR', // Valor por defecto
        ]);

        $afiliado->save();

        $afiliado->direccion()->create([
            'direccion_oficina'     => $row['direccion_1'],
            'ciudad_oficina'        => $row['estado'],
            'telefono_oficina'      => $row['número_telefónico_1'],
            'direccion_planta'      => $row['direccion_2'],
            'ciudad_planta'         => $row['estado'] ?? 'Caracas',
            'telefono_planta'       => $row['número_telefónico_2'],
        ]);

        $afiliado->personal()->create([
            'correo_presidente'                 => $row['correo_representante_ante_avipla'],
            'correo_gerente_general'            => '',
            'correo_gerente_compras'            => '',
            'correo_gerente_marketing_ventas'   => '',
            'correo_gerente_planta'             => '',
            'correo_gerente_recursos_humanos'   => '',
            'correo_administrador'              => '',
            'correo_gerente_exportaciones'      => '',
            'correo_representante_avipla'       => ''
        ]);

        return $afiliado;
    }
}
