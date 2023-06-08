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
        Schema::create('usuarios_especialidades', function (Blueprint $table) {
            $table->id();
            $table->string('cedula_user',10);
            // $table->unsignedBigInteger('id_especialidad');
            $table->timestamps();
            $table->foreign('cedula_user')->references('cedula')->on('usuarios');
            $table->foreignId('id_especialidad')->constrained(table:'especialidades');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios_especialidades');
    }
};
