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
        Schema::create('fichas_medicas_receta_medicas', function (Blueprint $table) {
            $table->id();
            // $table->integer('id_receta_medica');
            // $table->integer('id_fichas_medicas');

            //$table->primary(['id','id_receta_medica'],'Pk_recete_medica');
            $table->unique('id_fichas_medicas','Pk_fichas_medicas');
            $table->timestamps();


            $table->foreignId('id_receta_medica')->constrained(table:'receta_medicas');
            $table->foreignId('id_fichas_medicas')->constrained(table:'fichas_medicas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fichas_medicas_receta_medica');
    }
};
