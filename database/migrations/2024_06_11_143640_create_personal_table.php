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
        Schema::create('personal', function (Blueprint $table) {
            $table->id();
            $table
                ->foreignId('afiliado_id')
                ->references('id')
                ->on('afiliados')
                ->onDelete('CASCADE')
                ->onUpdate('CASCADE');
            $table->string('nombre_presidente');
            $table->string('correo_presidente');
            $table->string('nombre_gerente_general');
            $table->string('correo_gerente_general');
            $table->string('nombre_gerente_compras');
            $table->string('correo_gerente_compras');
            $table->string('nombre_gerente_marketing_ventas');
            $table->string('correo_gerente_marketing_ventas');
            $table->string('nombre_gerente_planta');
            $table->string('correo_gerente_planta');
            $table->string('nombre_gerente_recursos_humanos');
            $table->string('correo_gerente_recursos_humanos');
            $table->string('nombre_administrador');
            $table->string('correo_administrador');
            $table->string('nombre_gerente_exportaciones');
            $table->string('correo_gerente_exportaciones');
            $table->string('nombre_representante_avipla');
            $table->string('correo_representante_avipla');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('personal', function (Blueprint $table) {
            $table->dropForeign(['afiliado_id']);
            $table->dropForeign(['personal_rol_id']); 
        });
        Schema::dropIfExists('personal');
    }
};
