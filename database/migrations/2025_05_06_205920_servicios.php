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
        Schema::create('Servicios', function (Blueprint $table) {
            $table->bigIncrements('id_servicio');
            $table->string('nombre');
            $table->string('descripcion');
            $table->double('precio');
            $table->unsignedBigInteger('id_categoria');
            $table->boolean('desactivar')->default(false);
            $table->foreign('id_categoria')->references('id_categoria')->on('categorias_servicios')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('servicios');
    }

};
