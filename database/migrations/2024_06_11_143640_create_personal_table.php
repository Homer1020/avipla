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
            $table
                ->foreignId('personal_rol_id')
                ->references('id')
                ->on('afiliados')
                ->onDelete('CASCADE')
                ->onUpdate('CASCADE');
            $table->string('correo');
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
