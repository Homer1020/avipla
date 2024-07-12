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
        Schema::create('pagos', function (Blueprint $table) {
            $table->id();
            $table
                ->foreignId('aviso_cobro_id')
                ->references('id')
                ->on('aviso_cobros')
                ->onDelete('CASCADE')
                ->onUpdate('CASCADE');
            $table
                ->foreignId('metodo_pago_id')
                ->references('id')
                ->on('metodos_pago')
                ->onDelete('CASCADE')
                ->onUpdate('CASCADE');
            $table
                ->foreignId('banco_id')
                ->nullable()
                ->references('id')
                ->on('bancos')
                ->onDelete('CASCADE')
                ->onUpdate('CASCADE');
            $table->string('comprobante');
            $table->string('tasa')->nullable();
            $table->string('monto');
            $table->string('referencia')->nullable();
            $table->date('fecha_pago');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pagos', function(Blueprint $table) {
            $table->dropForeign(['invoice_id']);
            $table->dropForeign(['metodo_pago_id']);
        });
        Schema::dropIfExists('pagos');
    }
};
