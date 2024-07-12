<?php

namespace Database\Seeders;

use App\Models\MetodoPago;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MetodoPagoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MetodoPago::insert([
            ['metodo_pago'  => 'Pago movil'],
            ['metodo_pago'  => 'Transferencia'],
            ['metodo_pago'  => 'Efectivo'],
            ['metodo_pago'  => 'Otro']
        ]);
    }
}
