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
                ->references('id')
                ->on('users')
                ->onDelete('CASCADE')
                ->onUpdate('CASCADE');
            $table
                ->foreignId('afiliado_id')
                ->references('id')
                ->on('afiliados')
                ->onDelete('CASCADE')
                ->onUpdate('CASCADE');
            $table->enum('estado', ['PENDIENTE', 'REVISION', 'COMPLETADO', 'CANCELADO'])->default('PENDIENTE');
            $table->string('numero_factura')->unique();
            $table->string('codigo_factura')->unique();
            $table->string('monto_total');
            $table->string('documento');
            $table->text('observaciones')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('invoices', function(Blueprint $table) {
            $table->dropForeign(['afiliado_id']);
            $table->dropForeign(['user_id']);
        });
        Schema::dropIfExists('invoices');
    }
};
