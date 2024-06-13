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
            $table->string('nombre_presidente')->nullable();
            $table->string('correo_presidente')->nullable();
            $table->string('nombre_gerente_general')->nullable();
            $table->string('correo_gerente_general')->nullable();
            $table->string('nombre_gerente_compras')->nullable();
            $table->string('correo_gerente_compras')->nullable();
            $table->string('nombre_gerente_marketing_ventas')->nullable();
            $table->string('correo_gerente_marketing_ventas')->nullable();
            $table->string('nombre_gerente_planta')->nullable();
            $table->string('correo_gerente_planta')->nullable();
            $table->string('nombre_gerente_recursos_humanos')->nullable();
            $table->string('correo_gerente_recursos_humanos')->nullable();
            $table->string('nombre_administrador')->nullable();
            $table->string('correo_administrador')->nullable();
            $table->string('nombre_gerente_exportaciones')->nullable();
            $table->string('correo_gerente_exportaciones')->nullable();
            $table->string('nombre_representante_avipla')->nullable();
            $table->string('correo_representante_avipla')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('personal', function (Blueprint $table) {
            $table->dropForeign(['afiliado_id']);
        });
        Schema::dropIfExists('personal');
    }
};
