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
        Schema::create('administradores',function (Blueprint $table) {
            $table->bigIncrements('id_admin');
            $table->string('nombre');
            $table->string('correo');
            $table->string('contraseña');
            $table->enum('estado', ['activo', 'despedido'])->default('activo');
            $table->time('created_at')->nullable();
            $table->time('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('administradores');
    }
};
