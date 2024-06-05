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
                ->nullable()
                ->references('id')
                ->on('users')
                ->onDelete('CASCADE')
                ->onUpdate('CASCADE');
            $table->boolean('estado')->default(1); // -> estado del afiliado
            $table->string('razon_social');
            $table->string('rif')->unique();
            $table->text('direccion')->nullable();
            $table->string('pagina_web')->nullable();
            $table->string('telefono', 255)->unique()->nullable();

            // To confirm affiliates
            $table->string('confirmation_code')->nullable();
            $table->boolean('confirmed')->default(0);

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
