<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'email'     => 'admin@avipla.com',
            'password'  => bcrypt('admin123'),
            'name'      => 'Administrador AVIPLA'
        ]);

        $afiliado_role = Role::firstOrCreate(['name' => 'administrador']);
        $user->roles()->sync($afiliado_role);
    }
}
