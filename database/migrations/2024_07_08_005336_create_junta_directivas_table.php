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
        Schema::create('junta_directivas', function (Blueprint $table) {
            $table->id();
            $table
                ->foreignId('junta_directiva_role_id')
                ->references('id')
                ->on('junta_directiva_roles')
                ->onDelete('CASCADE')
                ->onUpdate('CASCADE');
            $table->string('nombre');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('junta_directivas', function(Blueprint $table) {
            $table->dropForeign(['junta_directiva_role_id']);
        });
        Schema::dropIfExists('junta_directivas');
    }
};
