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
        Schema::create('citas_medicas', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->timestamp('hora_inicio',6);
            $table->timestamp('hora_final',6);
            $table->boolean('pendiente');
            $table->integer('id_especialidad');
            $table->string('cedula_paciente',10);
            $table->timestamps();

            //index

            $table->index('fecha','fecha_init');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('citas_medicas');
    }
};
