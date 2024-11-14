<?php

namespace Database\Seeders;

use App\Models\Afiliado;
use App\Models\SolicitudAfiliado;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class AfiliadosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $afiliado_role = Role::create(['name' => 'afiliado']);

        for ($i = 0; $i < 4; $i++) {
            $solicitud = SolicitudAfiliado::create([
                'razon_social'  => "Test Empresa #{$i}",
                'correo'        => "test{$i}@gmail.com"  // Correo único para cada iteración
            ]);

            $afiliado = Afiliado::create([
                'razon_social'                  => "Test Empresa #{$i}",
                'rif'                           => "F-00000000{$i}",
                'anio_fundacion'                => '2001',
                'capital_social'                => '100',
                'pagina_web'                    => 'https://tepuy21.com',
                'actividad_id'                  => 1,
                'relacion_comercio_exterior'    => 'EXPORTADOR',
                'siglas'                        => 'FC',
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

            $user = $afiliado->users()->create([
                'name'          => "Test User #{$i}",
                'email'         => "test{$i}@gmail.com",    // Correo único para cada iteración
                'password'      => bcrypt('admin123'),
                'tipo_afiliado' => 0
            ]);
    
            $user->roles()->sync($afiliado_role);
    
            $solicitud->afiliado_id = $afiliado->id;
            $solicitud->save();
        }
    }
}
