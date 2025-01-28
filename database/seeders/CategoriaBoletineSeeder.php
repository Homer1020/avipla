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
                'display_name'  => 'Anuncios Corporativos',
                'name'          => 'anuncios-corporativos'
            ],
            [
                'display_name'  => 'Reconocimientos',
                'name'          => 'reconocimientos'
            ],
            [
                'display_name'  => 'Actualizaciones de Proyectos',
                'name'          => 'actualizaciones-de-proyectos'
            ],
            [
                'display_name'  => 'Nuevas Incorporaciones',
                'name'          => 'nuevas-incorporaciones'
            ],
            [
                'display_name'  => 'Capacitaciones y Cursos',
                'name'          => 'capacitaciones-y-cursos'
            ],
            [
                'display_name'  => 'Políticas y Procedimientos',
                'name'          => 'politicas-y-procedimientos'
            ],
            [
                'display_name'  => 'Eventos Internos',
                'name'          => 'eventos-internos'
            ],
            [
                'display_name'  => 'Mensajes de la Dirección',
                'name'          => 'mensajes-de-la-direccion'
            ]
        ]);        
    }
}
