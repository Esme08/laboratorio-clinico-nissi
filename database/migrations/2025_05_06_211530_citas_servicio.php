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
        Schema::create('Citas_Servicios', function (Blueprint $table) {
            $table->bigIncrements('id_cita_servicio');
            $table->unsignedBigInteger('id_cita');
            $table->unsignedBigInteger('id_servicio');
            $table->double('precio_servicio');
            $table->foreign('id_cita')->references('id_cita')->on('Citas')->onDelete('cascade');
            $table->foreign('id_servicio')->references('id_servicio')->on('Servicios')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('Citas_Servicios');
    }
};
