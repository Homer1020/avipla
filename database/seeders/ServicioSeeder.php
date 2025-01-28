<?php

namespace Database\Seeders;

use App\Models\Servicio;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServicioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Servicio::insert([
            ['nombre_servicio' => 'Moldeo por Inyección de Plástico'],
            ['nombre_servicio' => 'Fabricación de Envases Plásticos'],
            ['nombre_servicio' => 'Reciclaje de Plásticos'],
            ['nombre_servicio' => 'Diseño de Prototipos Plásticos'],
            ['nombre_servicio' => 'Distribución de Materias Primas Plásticas'],
            ['nombre_servicio' => 'Asesoría en Sustitución de Plásticos'],
            ['nombre_servicio' => 'Fabricación de Piezas Plásticas Personalizadas'],
            ['nombre_servicio' => 'Impresión 3D con Plásticos'],
            ['nombre_servicio' => 'Recubrimientos Plásticos Industriales'],
            ['nombre_servicio' => 'Producción de Film Plástico para Empaque'],
            ['nombre_servicio' => 'Inyección de Plásticos para Automoción'],
            ['nombre_servicio' => 'Fabricación de Accesorios para Construcción en Plástico'],
            ['nombre_servicio' => 'Fabricación de Mobiliario Plástico'],
            ['nombre_servicio' => 'Producción de Plásticos Biodegradables'],
            ['nombre_servicio' => 'Consultoría en Procesos de Plásticos Sostenibles'],
        ]);        
    }
}
