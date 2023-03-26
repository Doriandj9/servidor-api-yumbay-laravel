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
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('cedula',10)->unique('uq_cedula');
            $table->string('nombres')->nullable(false);
            $table->string('apellidos')->nullable(false);
            $table->string('direccion')->nullable(false);
            $table->string('celular',10)->nullable(true);
            $table->string('telefono')->nullable(true);
            $table->string('email')->nullable(false);
            $table->string('titulo')->nullable(true);
            $table->string('horario')->nullable(false);
            $table->string('contacto_emergencia',10)->nullable(false);
            $table->string('clave')->nullable(false);
            $table->integer('permisos')->nullable(false);
            $table->text('rol')->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
