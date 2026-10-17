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
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 150);
            $table->decimal('precio', 10,2);
            $table->string('imagen')->nullable();
            $table->string('categoria', 50); //en minucula: running, basketball, casual
            $table->string('marca', 50); //en minuscula: nike, converse
            $table->string('genero', 20)->default('unisex'); //hombre,mujer,unisex
            $table->unsignedInteger('stock')->default(0);
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
