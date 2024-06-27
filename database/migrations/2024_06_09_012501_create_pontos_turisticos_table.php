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
        Schema::create('pontos_turisticos', function (Blueprint $table) {
            $table->id();
            $table->string('titulo', 255);
            $table->longText('descricao');
            $table->decimal('latitude', $precision = 14, $scale = 8);
            $table->decimal('longitude', $precision = 14, $scale = 8);
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pontos_turisticos');
    }
};
