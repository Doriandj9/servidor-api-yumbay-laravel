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
        Schema::create('fichas_medicas_historia_clinicas', function (Blueprint $table) {
            $table->id();
            $table->integer('id_historia_clinica');
            $table->integer('id_fichas_medicas');

            //$table->primary(['id','id_historia_clinica'],'Pk_historia_clinica');
            $table->unique('id_fichas_medicas','Pk_fichas_medicas');
            $table->timestamps();

            $table->foreign('id_historia_clinica')->references('id')->on('historia_clinicas');
            $table->foreign('id_fichas_medicas')->references('id')->on('fichas_medicas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fichas_medicas_historia_clinica');
    }
};
