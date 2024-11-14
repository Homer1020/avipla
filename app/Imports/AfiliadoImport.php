<?php

namespace App\Imports;

use App\Models\Actividad;
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
        $actividadPrincipal = null;
        if (isset($row['actividad_id'])) {
            $actividadPrincipal = Actividad::firstOrNew([
                'id' => $row['actividad_id']
            ]);
        }

        $afiliado = new Afiliado([
            'razon_social'                  => $row['razon_social'],
            'rif'                           => $row['rif'],
            'anio_fundacion'                => $row['anio_fundacion'] ?? 0,
            'actividad_id'                  => $actividadPrincipal ? $actividadPrincipal->id : null,
            'pagina_web'                    => $row['pagina_web'] ?? null,
        ]);

        $afiliado->save();

        // Guardamos la dirección relacionada con la oficina y la planta
        $afiliado->direccion()->create([
            'direccion_oficina'     => $row['direccion_oficina'],
            'ciudad_oficina'        => $row['ciudad_oficina'],
            'telefono_oficina'      => $row['telefono_oficina'],
            'direccion_planta'      => $row['direccion_planta'],
            'ciudad_planta'         => $row['ciudad_planta'] ?? 'Caracas',
            'telefono_planta'       => $row['telefono_planta'],
        ]);

        // Guardamos los correos del personal asociado
        $afiliado->personal()->create([
            'correo_presidente'             => $row['correo_presidente'] ?? null,
            'numero_encargado_ws'           => $row['numero_encargado_ws'] ?? null,
            'correo_gerente_general'        => '',
            'correo_gerente_compras'        => '',
            'correo_gerente_marketing_ventas' => '',
            'correo_gerente_planta'         => '',
            'correo_gerente_recursos_humanos' => '',
            'correo_administrador'          => '',
            'correo_gerente_exportaciones'  => '',
            'correo_representante_avipla'   => ''
        ]);

        return $afiliado;
    }
}
