<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class EditorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear un rol de editor
        $editorRole = Role::firstOrCreate(['name' => 'editor']);

        // Permisos específicos para el editor
        $permissions = [
            // Permisos relacionados a avisos de cobro
            'view_aviso',
            
            // Permisos relacionados a boletines
            'view_boletine',
            'create_boletine',
            'update_boletine',
            'delete_boletine',
            
            // Permisos relacionados a noticias
            'view_noticia',
            'create_noticia',
            'update_noticia',
            'delete_noticia',
            
            // Permisos relacionados a categorías de boletines
            'view_category_boletine',
            'create_category_boletine',
            'update_category_boletine',
            'delete_category_boletine',
            
            // Permisos relacionados a etiquetas
            'view_tag',
            'create_tag',
            'update_tag',
            'delete_tag',
            
            // Permisos relacionados a categorías normales
            'view_category',
            'create_category',
            'update_category',
            'delete_category',

            // Permisos relacionados a comentarios
            'view_comment',
            'create_comment',
            'update_comment',
            'delete_comment',
        ];

        // Asignar permisos al rol de editor
        foreach ($permissions as $permission) {
            $perm = Permission::firstOrCreate(['name' => $permission]);
            $editorRole->givePermissionTo($perm);
        }

        $editorUser = User::create([
            'email'     => 'editor@avipla.test',
            'password'  => bcrypt('admin123'),
            'name'      => 'Editor (Moderador de contenido)'
        ]);

        // Asignar el rol de editor al usuario
        $editorUser->assignRole($editorRole);
    }
}
