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
        Schema::create('fichas_medicas', function (Blueprint $table) {
            $table->id();
            $table->string('cedula',10);
            $table->text('nombres');
            $table->text('apellidos');
            $table->text('direccion');
            $table->string('celular',10);
            $table->date('fecha_nacimiento');
            $table->text('email');
            $table->string('sexo',20);
            $table->string('edad',20);
            $table->string('estado_civil',40);
            $table->date('fecha_control');
            $table->string('hora_finalizacion',10);
            $table->text('unidad_operativa');
            $table->text('antecedentes')->nullable();
            $table->text('enfermedad_actual')->nullable();
            $table->text('odontograma')->nullable();
            $table->string('cedula_paciente',10);// foreig key -> pacientes
            $table->timestamps();

            $table->foreign('cedula_paciente')->references('cedula')->on('pacientes');
            $table->foreignId('id_especialidad')->constrained(table:'especialidades');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fichas_medicas');
    }
};
