<?php

namespace Database\Seeders;

use App\Models\Afiliado;
use App\Models\Role;
use App\Models\SolicitudAfiliado;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AfiliadosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $afiliado_role = Role::where('name', 'afiliado')->get();

        for ($i = 0; $i < 4; $i++) {
            $solicitud = SolicitudAfiliado::create([
                'razon_social'  => "Tepuy 21 #{$i}",
                'correo'        => "ingenieroquero{$i}@gmail.com"  // Correo único para cada iteración
            ]);
    
            $user = User::create([
                'name'      => "Ricardo Briceño #{$i}",
                'email'     => "ingenieroquero{$i}@gmail.com",    // Correo único para cada iteración
                'password'  => bcrypt('admin123'),
            ]);
    
            $user->roles()->sync($afiliado_role);
    
            $afiliado = $user->afiliado()->create([
                'razon_social'                  => "Tepuy 21 #{$i}",
                'rif'                           => "F-00000000{$i}",
                'anio_fundacion'                => '2001',
                'capital_social'                => '100',
                'pagina_web'                    => 'https://tepuy21.com',
                'actividad_id'                  => 1,
                'relacion_comercio_exterior'    => 'EXPORTADOR',
                'siglas'                        => 'FC',
                'brand'                         => 'brand.png',
                'rif_path'                      => 'brand.pdf',
                'estado_financiero_path'        => 'brand.pdf',
                'registro_mercantil_path'       => 'brand.pdf',
            ]);
    
            $afiliado->direccion()->create([
                'direccion_oficina'     => 'Plaza Bolivar',
                'ciudad_oficina'        => 'Caracas',
                'telefono_oficina'      => '0412001010101',
                'direccion_planta'      => 'Plaza Bolivar',
                'ciudad_planta'         => 'Caracas',
                'telefono_planta'       => '0412012121333'
            ]);
    
            $afiliado->personal()->create([
                'correo_presidente'                 => '',
                'correo_gerente_general'            => '',
                'correo_gerente_compras'            => '',
                'correo_gerente_marketing_ventas'   => '',
                'correo_gerente_planta'             => '',
                'correo_gerente_recursos_humanos'   => '',
                'correo_administrador'              => '',
                'correo_gerente_exportaciones'      => '',
                'correo_representante_avipla'       => ''
            ]);
    
            $solicitud->afiliado_id = $afiliado->id;
            $solicitud->save();
        }
    }
}
