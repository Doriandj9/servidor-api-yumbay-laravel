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
        Schema::create('fichas_medicas_signos_vitales', function (Blueprint $table) {
            $table->id();
            $table->integer('id_signos_vitales');
            $table->integer('id_fichas_medicas');

           // $table->primary(['id','id_signos_vitales']);
            $table->unique('id_fichas_medicas','Pk_fichas_medicas');
            $table->timestamps();

            $table->foreign('id_signos_vitales')->references('id')->on('signos_vitales');
            $table->foreign('id_fichas_medicas')->references('id')->on('fichas_medicas');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fichas_medicas_signos_vitales');
    }
};
