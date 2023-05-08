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
        Schema::create('historia_clinicas', function (Blueprint $table) {
            $table->id();
            $table->string('hora',8);
            $table->text('motivo_consulta');
            $table->text('antecedentes_medicos')->nullable();
            $table->text('tratamiento_actual')->nullable();
            $table->text('alergias')->nullable();
            $table->text('habitos_toxicos')->nullable();
            $table->text('otros_antecedentes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historia_clinica');
    }
};
