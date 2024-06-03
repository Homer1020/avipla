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
                ->foreignId('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('CASCADE')
                ->onUpdate('CASCADE');
            $table->boolean('estado'); // -> estado del afiliado
            $table->string('razon_social');
            $table->string('RIF');
            $table->text('direccion');
            $table->string('nombre'); // -> persona a cargo
            $table->string('telefono'); // -> telefono de la persona a cargo
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
