<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::insert([
            [
                'display_name'  => 'Carros',
                'name'          => 'carros'
            ],
            [
                'display_name'  => 'Motos',
                'name'          => 'motos'
            ],
            [
                'display_name'  => 'Bicicletas',
                'name'          => 'bicicletas'
            ],
            [
                'display_name'  => 'Clima',
                'name'          => 'clima'
            ]
        ]);
    }
}
