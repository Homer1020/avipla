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
        Schema::create('solicitudes_afiliados', function (Blueprint $table) {
            $table->id();
            $table
                ->string('razon_social');
            $table
                ->string('correo')
                ->unique();

            $table
                ->foreignId('afiliado_id')
                ->nullable()
                ->references('id')
                ->on('afiliados')
                ->onDelete('CASCADE')
                ->onUpdate('CASCADE');

            // To confirm affiliates
            $table->string('confirmation_code')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solicitudes_afiliados');
    }
};
