<?php

namespace Database\Seeders;

use App\Models\Banco;
use Illuminate\Database\Seeder;

class BancoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bancos = [
            ['codigo' => '0001', 'nombre' => 'BANCO CENTRAL DE VENEZUELA'],
            ['codigo' => '0102', 'nombre' => 'BANCO DE VENEZUELA S.A.C.A. BANCO UNIVERSAL'],
            ['codigo' => '0104', 'nombre' => 'VENEZOLANO DE CRÉDITO, S.A. BANCO UNIVERSAL'],
            ['codigo' => '0105', 'nombre' => 'BANCO MERCANTIL, C.A. S.A.C.A. BANCO UNIVERSAL'],
            ['codigo' => '0108', 'nombre' => 'BANCO PROVINCIAL, S.A. BANCO UNIVERSAL'],
            ['codigo' => '0114', 'nombre' => 'BANCO DEL CARIBE, C.A. BANCO UNIVERSAL'],
            ['codigo' => '0115', 'nombre' => 'BANCO EXTERIOR, C.A. BANCO UNIVERSAL'],
            ['codigo' => '0116', 'nombre' => 'BANCO OCCIDENTAL DE DESCUENTO BANCO UNIVERSAL, C.A.'],
            ['codigo' => '0128', 'nombre' => 'BANCO CARONI, C.A. BANCO UNIVERSAL'],
            ['codigo' => '0134', 'nombre' => 'BANESCO BANCO UNIVERSAL S.A.C.A.'],
            ['codigo' => '0137', 'nombre' => 'BANCO SOFITASA BANCO UNIVERSAL, C.A.'],
            ['codigo' => '0138', 'nombre' => 'BANCO PLAZA, BANCO UNIVERSAL C.A.'],
            ['codigo' => '0146', 'nombre' => 'BANCO DE LA GENTE EMPRENDEDORA BANGENTE, C.A.'],
            ['codigo' => '0149', 'nombre' => 'BANCO DEL PUEBLO SOBERANO, BANCO DE DESARROLLO'],
            ['codigo' => '0151', 'nombre' => 'BFC BANCO FONDO COMUN C.A. BANCO UNIVERSAL'],
            ['codigo' => '0157', 'nombre' => 'DELSUR BANCO UNIVERSAL, C.A.'],
            ['codigo' => '0163', 'nombre' => 'BANCO DEL TESORO, C.A. BANCO UNIVERSAL'],
            ['codigo' => '0166', 'nombre' => 'BANCO AGRICOLA DE VENEZUELA, C.A. BANCO UNIVERSAL'],
            ['codigo' => '0168', 'nombre' => 'BANCRECER S.A. BANCO DE DESARROLLO'],
            ['codigo' => '0169', 'nombre' => 'MI BANCO, BANCO MICROFINANCIERO, C.A.'],
            ['codigo' => '0171', 'nombre' => 'BANCO ACTIVO, C.A. BANCO UNIVERSAL'],
            ['codigo' => '0172', 'nombre' => 'BANCAMIGA BANCO MICROFINANCIERO, C.A.'],
            ['codigo' => '0173', 'nombre' => 'BANCO INTERNACIONAL DE DESARROLLO, C.A. BANCO UNIVERSAL'],
            ['codigo' => '0174', 'nombre' => 'BANPLUS BANCO UNIVERAL, C.A.'],
            ['codigo' => '0175', 'nombre' => 'BANCO BICENTENARIO BANCO UNIVERSAL, C.A.'],
            ['codigo' => '0176', 'nombre' => 'NOVO BANCO, S.A. SUCURSAL VENEZUELA BANCO UNIVERSAL'],
            ['codigo' => '0177', 'nombre' => 'BANCO DE LA FUERZA ARMADA NACIONAL BOLIVARIANA, B.U.'],
            ['codigo' => '0190', 'nombre' => 'CITIBANK N.A.'],
            ['codigo' => '0191', 'nombre' => 'BANCO NACIONAL CRÉDITO, C.A. BANCO UNIVERSAL'],
        ];

        foreach ($bancos as $banco) {
            Banco::insert($banco);
        }
    }
}
