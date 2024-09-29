<?php

namespace Database\Seeders;

use App\Models\Afiliado;
use App\Models\User;
use Illuminate\Database\Seeder;

class AvisoCobroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $afiliados = Afiliado::all();
        $user = User::whereHas('roles', function ($query) {
            $query->where('name', 'admin');
        })->first();
        $codigos = ['FEBRERO2024', 'MARZO2024', 'ABRIL2024', 'MAYO2024', 'JUNIO2024', 'JULIO2024'];
        foreach($codigos as $index => $codigo) {
            foreach($afiliados as $afiliado) {
                $user->avisosCobros()->create([
                    'monto_total'   => '100.00',
                    'fecha_limite'  => '2024-0' . $index + 2 . '-01',
                    'created_at'  => '2024-0' . $index + 2 . '-01',
                    'updated_at'  => '2024-0' . $index + 2 . '-01',
                    'afiliado_id'   => $afiliado->id,
                    'codigo_aviso'  => $codigo
                ]);
            }
        }
        
    }
}
