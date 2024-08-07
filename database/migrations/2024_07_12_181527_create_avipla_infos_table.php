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
        Schema::create('avipla_infos', function (Blueprint $table) {
            $table->id();
            $table->string('junta_directiva_anio_inicio');
            $table->string('junta_directiva_anio_fin');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('avipla_infos');
    }
};
