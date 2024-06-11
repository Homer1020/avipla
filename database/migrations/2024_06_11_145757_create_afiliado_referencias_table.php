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
        Schema::create('afiliado_referencias', function (Blueprint $table) {
            $table
                ->foreignId('afiliado_id')
                ->references('id')
                ->on('afiliados')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
            $table
                ->foreignId('afiliado_referencia_id')
                ->references('id')
                ->on('afiliados')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('afiliado_referencias', function (Blueprint $table) {
            $table->dropForeign(['afiliado_id']);
            $table->dropForeign(['afiliado_referencia_id']);
        });
        Schema::dropIfExists('afiliado_referencias');
    }
};
