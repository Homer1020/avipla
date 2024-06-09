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
                ->foreignId('invoice_id')
                ->references('id')
                ->on('invoices')
                ->onDelete('CASCADE')
                ->onUpdate('CASCADE');
            $table
                ->foreignId('metodo_pago_id')
                ->references('id')
                ->on('metodos_pago')
                ->onDelete('CASCADE')
                ->onUpdate('CASCADE');
            $table->integer('monto');
            $table->string('comprobante');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pagos', function(Blueprint $table) {
            $table->dropForeign(['invoice_id', 'metodo_pago_id']);
        });
        Schema::dropIfExists('pagos');
    }
};
