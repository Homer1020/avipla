<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'user',
            'afiliado',
            'role',
            'solicitud',
            'factura',
            'aviso',
            'noticia',
            'boletine',
            'category',
            'tag',
            'category_boletine',
            'pago',
            'comment'
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => "view_{$permission}"]);
            Permission::create(['name' => "create_{$permission}"]);
            Permission::create(['name' => "update_{$permission}"]);
            Permission::create(['name' => "delete_{$permission}"]);
        }
    }
}
