<?php

namespace Database\Seeders;

use App\Models\MateriaPrima;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MateriaPrimaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MateriaPrima::insert([
            ['materia_prima' => 'Acero'],
            ['materia_prima' => 'Cobre'],
            ['materia_prima' => 'Vidrio'],
            ['materia_prima' => 'Cemento'],
            ['materia_prima' => 'Cuero'],
            ['materia_prima' => 'Lana'],
            ['materia_prima' => 'Papel'],
            ['materia_prima' => 'Piedra'],
            ['materia_prima' => 'Arena'],
            ['materia_prima' => 'Caucho']
        ]);        
    }
}
