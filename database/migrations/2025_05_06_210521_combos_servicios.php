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
        Schema::create('combos_servicios',function (Blueprint $table){
            $table->bigIncrements('id_combo_servicio');
            $table->unsignedBigInteger('id_combo');
            $table->unsignedBigInteger('id_servicio');
            $table->foreign('id_combo')->references('id_combo')->on('Combos')->onDelete('cascade');
            $table->foreign('id_servicio')->references('id_servicio')->on('Servicios')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('combos_servicios');
    }
};
