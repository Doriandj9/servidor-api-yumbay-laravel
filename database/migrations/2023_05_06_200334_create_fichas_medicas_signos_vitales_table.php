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
            // $table->integer('id_signos_vitales');
            // $table->integer('id_fichas_medicas');

           // $table->primary(['id','id_signos_vitales']);
            $table->timestamps();

            $table->foreignId('id_signos_vitales')->constrained(table:'signos_vitales');
            $table->foreignId('id_fichas_medicas')->constrained(table:'fichas_medicas');
            $table->unique('id_fichas_medicas','Pk_fichas_medicas');


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
