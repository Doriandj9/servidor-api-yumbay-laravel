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
            $table->double('talla');
            $table->double('peso');
            $table->double('temperatura');
            $table->text('frecuencia_respiratoria');
            $table->text('frecuencia_cardiaca');
            $table->text('presion_arterial');
            $table->text('auscultacion_cardiaca');
            $table->text('auscultacion_pulmonar');
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
