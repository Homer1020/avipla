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
        Schema::create('aviso_cobros', function (Blueprint $table) {
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
            $table->enum('estado', ['PENDIENTE', 'REVISION', 'CONCILIADO', 'DEVUELTO'])->default('PENDIENTE');
            $table->string('codigo_aviso');
            $table->decimal('monto_total');
            $table->text('observaciones')->nullable();
            $table->date('fecha_limite')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aviso_cobros');
    }
};
