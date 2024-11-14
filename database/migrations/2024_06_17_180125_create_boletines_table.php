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
        Schema::create('boletines', function (Blueprint $table) {
            $table->id();
            $table
                ->foreignId('user_id')
                ->nullable()
                ->references('id')
                ->on('users')
                ->onDelete('SET NULL')
                ->onUpdate('CASCADE');
            $table
                ->foreignId('category_id')
                ->nullable()
                ->references('id')
                ->on('categoria_boletines')
                ->onDelete('SET NULL')
                ->onUpdate('CASCADE');
            $table
                ->string('titulo')
                ->unique();
            $table->string('slug');
            $table->longText('contenido');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('boletines', function(Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['category_id']);
        });
        Schema::dropIfExists('boletins');
    }
};
