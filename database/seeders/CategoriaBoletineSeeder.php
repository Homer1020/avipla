<?php

namespace Database\Seeders;

use App\Models\CategoriaBoletine;
use Illuminate\Database\Seeder;

class CategoriaBoletineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CategoriaBoletine::insert([
            [
                'display_name'  => 'Noticias',
                'name'          => 'noticias'
            ],
            [
                'display_name'  => 'Eventos',
                'name'          => 'eventos'
            ],
            [
                'display_name'  => 'Opinión',
                'name'          => 'opinion'
            ],
            [
                'display_name'  => 'Recursos',
                'name'          => 'recursos'
            ]
        ]);
    }
}
