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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table
                ->foreignId('user_id')
                ->nullable()
                ->references('id')
                ->on('users')
                ->onDelete('CASCADE')
                ->onUpdate('CASCADE');
            $table
                ->foreignId('afiliado_id')
                ->nullable()
                ->references('id')
                ->on('afiliados')
                ->onDelete('CASCADE')
                ->onUpdate('CASCADE');
            $table->enum('estado', ['PENDIENTE', 'COMPLETADO', 'CANCELADO'])->default('PENDIENTE');
            $table->string('numero_factura')->unique();
            $table->string('concepto');
            $table->string('monto_total');
            $table->string('documento');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('afiliados', function(Blueprint $table) {
            $table->dropForeign(['user_id', 'afiliado_id']);
        });
        Schema::dropIfExists('invoices');
    }
};
