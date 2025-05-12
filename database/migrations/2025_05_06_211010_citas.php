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
        Schema::create('Citas', function (Blueprint $table) {
            $table->bigIncrements('id_cita');
            $table->string('nombre_cliente');
            $table->string('correo_cliente')->nullable();
            $table->string('telefono_cliente')->nullable();
            $table->date('fecha');
            $table->time('hora');
            $table->string('estado');
            $table->text('servicios_seleccionados');
            $table->double('precio_total');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('Citas');
    }
};
