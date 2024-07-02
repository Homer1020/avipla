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
        Schema::create('tag_noticia', function (Blueprint $table) {
            $table
                ->foreignId('tag_id')
                ->nullable()
                ->references('id')
                ->on('tags')
                ->onDelete('CASCADE')
                ->onUpdate('CASCADE');
            $table
                ->foreignId('noticia_id')
                ->nullable()
                ->references('id')
                ->on('noticias')
                ->onDelete('CASCADE')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tag_noticia', function (Blueprint $table) {
            $table->dropForeign(['tag_id']);
            $table->dropForeign(['noticia_id']);
        });
        Schema::dropIfExists('tag_noticia');
    }
};
