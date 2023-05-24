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
        Schema::create('signos_vitales', function (Blueprint $table) {
            $table->id();
            $table->double('talla')->nullable();
            $table->double('peso')->nullable();
            $table->double('temperatura')->nullable();
            $table->text('frecuencia_respiratoria')->nullable();
            $table->text('frecuencia_cardiaca')->nullable();
            $table->text('presion_arterial')->nullable();
            $table->text('auscultacion_cardiaca')->nullable();
            $table->text('auscultacion_pulmonar')->nullable();
            $table->text('otros_hallazgos')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('signos_vitales');
    }
};
