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
        Schema::create('linea_productos', function (Blueprint $table) {
            $table
                ->foreignId('producto_id')
                ->references('id')
                ->on('productos')
                ->onDelete('CASCADE')
                ->onUpdate('CASCADE');
            $table
                ->foreignId('afiliado_id')
                ->references('id')
                ->on('afiliados')
                ->onDelete('CASCADE')
                ->onUpdate('CASCADE');
            $table->string('produccion_total_mensual');
            $table->string('porcentage_exportacion');
            $table->string('mercado_exportacion');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('linea_productos', function (Blueprint $table) {
            $table->dropForeign(['afiliado_id']);
            $table->dropForeign(['producto_id']);
        });
        Schema::dropIfExists('linea_productos');
    }
};
