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
        Schema::create('direcciones', function (Blueprint $table) {
            $table->id();
            $table
                ->foreignId('afiliado_id')
                ->references('id')
                ->on('afiliados')
                ->onDelete('CASCADE')
                ->onUpdate('CASCADE');
            $table->string('direccion_oficina')->nullable();
            $table->string('ciudad_oficina')->nullable();
            $table->string('telefono_oficina')->nullable();
            $table->string('direccion_planta')->nullable();
            $table->string('ciudad_planta')->nullable();
            $table->string('telefono_planta')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('direcciones', function (Blueprint $table) {
           $table->dropForeign(['afiliado_id']); 
        });
        Schema::dropIfExists('direcciones');
    }
};
