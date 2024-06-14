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
        Schema::create('noticias', function (Blueprint $table) {
            $table->id();
            $table
                ->foreignId('categoria_id')
                ->references('id')
                ->on('categories')
                ->onDelete('RESTRICT')
                ->onUpdate('CASCADE');
            $table
                ->foreignId('user_id')
                ->nullable()
                ->references('id')
                ->on('users')
                ->onDelete('SET NULL')
                ->onUpdate('CASCADE');
            $table->string('slug');
            $table->string('titulo')->unique();
            $table->longText('contenido');
            $table->string('thumbnail');
            $table->enum('estatus', ['DRAFT', 'PUBLISHED', 'DELETED'])->default('PUBLISHED');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('noticias', function(Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['categoria_id']);
        });
        Schema::dropIfExists('noticias');
    }
};
