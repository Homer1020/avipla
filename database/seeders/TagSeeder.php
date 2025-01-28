<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tag::insert([
            [
                'display_name' => 'Reciclaje',
                'name'         => 'reciclaje'
            ],
            [
                'display_name' => 'Bioplásticos',
                'name'         => 'bioplasticos'
            ],
            [
                'display_name' => 'Sostenibilidad',
                'name'         => 'sostenibilidad'
            ],
            [
                'display_name' => 'Contaminación por Plástico',
                'name'         => 'contaminacion-por-plastico'
            ],
            [
                'display_name' => 'Economía Circular',
                'name'         => 'economia-circular'
            ],
            [
                'display_name' => 'Innovación en Plásticos',
                'name'         => 'innovacion-en-plasticos'
            ],
            [
                'display_name' => 'Microplásticos',
                'name'         => 'microplasticos'
            ],
            [
                'display_name' => 'Reducción de Residuos',
                'name'         => 'reduccion-de-residuos'
            ],
            [
                'display_name' => 'Regulaciones de Plásticos',
                'name'         => 'regulaciones-de-plasticos'
            ],
            [
                'display_name' => 'Industria del Plástico',
                'name'         => 'industria-del-plastico'
            ],
            [
                'display_name' => 'Tendencias en Materiales',
                'name'         => 'tendencias-en-materiales'
            ],
            [
                'display_name' => 'Impacto Ambiental',
                'name'         => 'impacto-ambiental'
            ],
            [
                'display_name' => 'Tecnología de Plásticos',
                'name'         => 'tecnologia-de-plasticos'
            ],
            [
                'display_name' => 'Reutilización de Plásticos',
                'name'         => 'reutilizacion-de-plasticos'
            ],
            [
                'display_name' => 'Productos Biodegradables',
                'name'         => 'productos-biodegradables'
            ],
            [
                'display_name' => 'Políticas Globales',
                'name'         => 'politicas-globales'
            ],
            [
                'display_name' => 'Innovaciones Industriales',
                'name'         => 'innovaciones-industriales'
            ],
            [
                'display_name' => 'Proyectos de Reciclaje',
                'name'         => 'proyectos-de-reciclaje'
            ],
            [
                'display_name' => 'Alternativas al Plástico',
                'name'         => 'alternativas-al-plastico'
            ],
            [
                'display_name' => 'Plásticos en la Automoción',
                'name'         => 'plasticos-en-la-automocion'
            ]
        ]);        
    }
}
