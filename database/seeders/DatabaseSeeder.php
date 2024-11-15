<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(PermissionSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(ActividadSeeder::class);
        $this->call(CategorySeeder::class);

        // $this->call(ProductoSeeder::class);
        // $this->call(MateriaPrimaSeeder::class);
        // $this->call(ServicioSeeder::class);
        // $this->call(AfiliadosSeeder::class);
        // $this->call(AvisoCobroSeeder::class);
        
        $this->call(MetodoPagoSeeder::class);
        $this->call(CategoriaBoletineSeeder::class);
        $this->call(JuntaDirectivaRoleSeeder::class);
        $this->call(BancoSeeder::class);
    }
}
