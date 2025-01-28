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
                'display_name'  => 'Tipos de Plásticos',
                'name'          => 'tipos-de-plasticos'
            ],
            [
                'display_name'  => 'Reciclaje y Sostenibilidad',
                'name'          => 'reciclaje-y-sostenibilidad'
            ],
            [
                'display_name'  => 'Usos del Plástico en la Industria',
                'name'          => 'usos-del-plastico-en-la-industria'
            ],
            [
                'display_name'  => 'Innovaciones y Nuevas Tecnologías',
                'name'          => 'innovaciones-y-nuevas-tecnologias'
            ],
            [
                'display_name'  => 'Normativas y Legislación',
                'name'          => 'normativas-y-legislacion'
            ],
            [
                'display_name'  => 'Impacto del Plástico en el Medio Ambiente',
                'name'          => 'impacto-del-plastico-en-el-medio-ambiente'
            ],
            [
                'display_name'  => 'Educación y Conciencia',
                'name'          => 'educacion-y-conciencia'
            ],
            [
                'display_name'  => 'Alternativas al Plástico',
                'name'          => 'alternativas-al-plastico'
            ],
            [
                'display_name'  => 'Historia del Plástico',
                'name'          => 'historia-del-plastico'
            ],
            [
                'display_name'  => 'Tendencias de Mercado',
                'name'          => 'tendencias-de-mercado'
            ]
        ]);        
    }
}
