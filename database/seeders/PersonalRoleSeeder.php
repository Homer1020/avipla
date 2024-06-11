<?php

namespace Database\Seeders;

use App\Models\PersonalRole;
use Illuminate\Database\Seeder;

class PersonalRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PersonalRole::insert([
            ['nombre_rol' => 'Presidente'],
            ['nombre_rol' => 'Gerente General'],
            ['nombre_rol' => 'Gerente de Compras'],
            ['nombre_rol' => 'Gerente de Mercadeo y/o Ventas'],
            ['nombre_rol' => 'Gerente de Planta'],
            ['nombre_rol' => 'Gerente de Recursos Humanos'],
            ['nombre_rol' => 'Administrador'],
            ['nombre_rol' => 'Gerente de Exportaciones'],
            ['nombre_rol' => 'Representante ante AVIPLA']
        ]);
    }
}
