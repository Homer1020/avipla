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
            ['nombre' => 'Carro'],
            ['nombre' => 'Bicicleta'],
            ['nombre' => 'Teclado'],
            ['nombre' => 'Pizarra'],
            ['nombre' => 'Tornillo'],
            ['nombre' => 'Cama'],
            ['nombre' => 'Disco'],
        ]);
    }
}
