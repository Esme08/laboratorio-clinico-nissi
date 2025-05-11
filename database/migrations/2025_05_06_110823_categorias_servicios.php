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
        //
        Schema::create('categorias_servicios', function (Blueprint $table) {
            $table->bigIncrements('id_categoria');
            $table->string('nombre');
            $table->unsignedBigInteger('id_categoria_padre')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('categorias_servicios');
    }
};
