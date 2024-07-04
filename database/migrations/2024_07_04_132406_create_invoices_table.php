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
                ->foreignId('pago_id')
                ->references('id')
                ->on('pagos')
                ->onDelete('CASCADE')
                ->onUpdate('CASCADE');
            $table
                ->foreignId('aviso_cobro_id')
                ->references('id')
                ->on('aviso_cobros')
                ->onDelete('CASCADE')
                ->onUpdate('CASCADE');
            $table
                ->foreignId('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('CASCADE')
                ->onUpdate('CASCADE');
            $table->string('numero_factura')->unique();
            $table->string('codigo_factura')->unique();
            $table->string('invoice_path');
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
            $table->dropForeign(['user_id']);
            $table->dropForeign(['aviso_cobro_id']);
            $table->dropForeign(['pago_id']);
        });
        Schema::dropIfExists('invoices');
    }
};
