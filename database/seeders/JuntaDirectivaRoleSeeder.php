<?php

namespace Database\Seeders;

use App\Models\JuntaDirectivaRole;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JuntaDirectivaRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        JuntaDirectivaRole::insert([
            ['display_name' => 'Presidente'],
            ['display_name' => 'Vice presidente'],
            ['display_name' => 'Tesorero'],
            ['display_name' => 'Directores principales'],
            ['display_name' => 'Director ejecutivo'],
            ['display_name' => 'Directores secundarios'],
        ]);
    }
}
