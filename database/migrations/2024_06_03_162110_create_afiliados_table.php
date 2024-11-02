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
        Schema::create('afiliados', function (Blueprint $table) {
            $table->id();
            $table
                ->foreignId('actividad_id')
                ->nullable()
                ->references('id')
                ->on('actividades')
                ->onDelete('SET NULL')
                ->onUpdate('CASCADE');
            $table->string('razon_social');
            $table->string('brand')->nullable();
            $table->string('rif')->unique();
            $table->string('siglas')->nullable();
            $table->string('anio_fundacion')->nullable();
            $table->decimal('capital_social')->nullable();
            $table->string('pagina_web')->nullable();
            $table->enum('relacion_comercio_exterior', ['IMPORTADOR', 'EXPORTADOR', 'AMBOS']);
            $table->string('rif_path')->nullable();
            $table->string('estado_financiero_path')->nullable();
            $table->string('registro_mercantil_path')->nullable();
            $table->boolean('account_status')->default(true);
            
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        /**
         * Eliminar foreign key primero importante
         */
        Schema::table('afiliados', function(Blueprint $table) {
            $table->dropForeign(['user_id']);
        });
        Schema::dropIfExists('afiliados');
    }
};
