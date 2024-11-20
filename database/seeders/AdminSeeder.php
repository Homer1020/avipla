<?php

namespace Database\Seeders;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
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
        $admin_role = Role::create(['name' => 'admin']);

        $permissions = Permission::pluck('id', 'id')->all();
        $admin_role->syncPermissions($permissions);

        $user = User::create([
            'email'     => 'admin@avipla.online',
            'password'  => bcrypt('admin123'),
            'name'      => 'Administrador AVIPLA'
        ]);

        $user->roles()->sync($admin_role);
    }
}
