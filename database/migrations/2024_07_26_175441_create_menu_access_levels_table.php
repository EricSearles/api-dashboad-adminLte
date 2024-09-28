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
        Schema::create('menu_access_levels', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('menu_id'); // Definindo a coluna menu_id
            $table->unsignedBigInteger('access_level_id'); // Definindo a coluna access_level_id
            $table->foreign('menu_id')->references('id')->on('menus')->onDelete('cascade');
            $table->foreign('access_level_id')->references('id')->on('access_levels')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_access_levels');
    }
};
