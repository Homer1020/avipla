<?php

namespace Database\Seeders;

use App\Models\Afiliado;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AfiliadosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Afiliado::insert([
            [
                'razon_social' => 'Empresas Polar',
                'rif' => '000000000',
                'direccion' => 'La Candelaria.',
                'telefono' => '0250123456',
                'pagina_web' => 'https://www.empresaspolar.com/',
                'correo' => 'info@empresaspolar.com'
            ],
            [
                'razon_social' => 'Corporación Venezolana de Alimentos (CVA)',
                'rif' => '000000001',
                'direccion' => 'Los Ruices.',
                'telefono' => '02123456789',
                'pagina_web' => 'https://www.cvalimentos.com/',
                'correo' => 'contacto@cvalimentos.com'
            ],
            [
                'razon_social' => 'Grupo Mavesa',
                'rif' => '000000002',
                'direccion' => 'El Recreo.',
                'telefono' => '02951234567',
                'pagina_web' => 'https://www.grupomavesa.com/',
                'correo' => 'info@grupomavesa.com'
            ],
            [
                'razon_social' => 'Empresas Santa María',
                'rif' => '000000003',
                'direccion' => 'Los Chaguaramos.',
                'telefono' => '02129876543',
                'pagina_web' => 'https://www.empresas-santamaria.com/',
                'correo' => 'contacto@empresas-santamaria.com'
            ],
            [
                'razon_social' => 'Plumrose Venezuela',
                'rif' => '000000004',
                'direccion' => 'La Urbina.',
                'telefono' => '02122345678',
                'pagina_web' => 'https://www.plumrose.com.ve/',
                'correo' => 'info@plumrose.com.ve'
            ]
        ]);
    }
}
