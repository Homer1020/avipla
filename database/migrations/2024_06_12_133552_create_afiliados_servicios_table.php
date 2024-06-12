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
        Schema::create('afiliados_servicios', function (Blueprint $table) {
            $table
                ->foreignId('afiliado_id')
                ->references('id')
                ->on('afiliados')
                ->onDelete('CASCADE')
                ->onUpdate('CASCADE');
            $table
                ->foreignId('servicio_id')
                ->references('id')
                ->on('servicios')
                ->onDelete('CASCADE')
                ->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('afiliados_servicios', function (Blueprint $table) {
            $table->dropForeign(['afiliado_id']);
            $table->dropForeign(['servicio_id']);
        });
        Schema::dropIfExists('afiliados_servicios');
    }
};
