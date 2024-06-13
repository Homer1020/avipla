<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('afiliado_materias_primas', function (Blueprint $table) {
            $table
                ->foreignId('materia_prima_id')
                ->references('id')
                ->on('materias_primas')
                ->onDelete('CASCADE')
                ->onUpdate('CASCADE');
            $table
                ->foreignId('afiliado_id')
                ->references('id')
                ->on('afiliados')
                ->onDelete('CASCADE')
                ->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('afiliado_materias_primas', function (Blueprint $table) {
            $table->dropForeign(['afiliado_id']);
            $table->dropForeign(['materia_prima_id']);
        });
        Schema::dropIfExists('afiliado_materias_primas');
    }
};
