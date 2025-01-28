<?php

namespace Database\Seeders;

use App\Models\Producto;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Producto::insert([
            ['nombre' => 'Botellas de Plástico'],
            ['nombre' => 'Envases para Alimentos'],
            ['nombre' => 'Tubos de PVC'],
            ['nombre' => 'Plásticos Biodegradables'],
            ['nombre' => 'Película Plástica para Empaque'],
            ['nombre' => 'Cajas de Plástico Reutilizables'],
            ['nombre' => 'Tuberías Corrugadas'],
            ['nombre' => 'Tapas y Tapones'],
            ['nombre' => 'Piezas de Plástico Inyectado'],
            ['nombre' => 'Accesorios de Plástico para Construcción'],
            ['nombre' => 'Materiales de Plástico para Automoción'],
            ['nombre' => 'Juguetes de Plástico'],
            ['nombre' => 'Utensilios de Cocina de Plástico'],
            ['nombre' => 'Mobiliario Plástico'],
            ['nombre' => 'Repuestos y Componentes Plásticos'],
        ]);        
    }
}
