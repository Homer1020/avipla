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
            ['materia_prima' => 'Madera'],
            ['materia_prima' => 'Algodón'],
            ['materia_prima' => 'Tierra'],
        ]);
    }
}
