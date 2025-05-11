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
        Schema::create('imagenes_clinica', function (Blueprint $table) {
            $table->bigIncrements('id_imagen');
            $table->unsignedBigInteger('id_clinica');
            $table->string('url_imagen');
            $table->foreign('id_clinica')->references('id_clinica')->on('clinica')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('imagenes_clinica');
    }
};
