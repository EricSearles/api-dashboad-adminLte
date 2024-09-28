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
        Schema::create('users_types', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Definindo a coluna user_id
            $table->unsignedBigInteger('type_of_user_id'); // Definindo a coluna type_of_user_id
            $table->foreign('user_id')->references('id')->on('user')->onDelete('cascade');
            $table->foreign('type_of_user_id')->references('id')->on('type_of_user')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users_types');
    }
};
