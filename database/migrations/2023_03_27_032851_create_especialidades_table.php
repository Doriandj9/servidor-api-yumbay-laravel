<?php

use App\Models\Especialidades;
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
        Schema::create('especialidades', function (Blueprint $table) {
            $table->id();
            $table->text('nombre');
            $table->text('descripcion');
            $table->text('img');
            $table->text('horario');
            $table->timestamps();
        });

        $this->inserData();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('especialidades');
    }

    /**
     * Insert data initial
     */

    public function inserData(): void
    {
        $data = [[
            'nombre' => 'Odontologia',
            'descripcion' => 'Sirve para los dientes',
            'img' => '',
            'horario' => 'LUNES-MARTES-MIERCOLES-JUEVES-VIERNES|8:00-18:00'
        ],
        [
            'nombre' => 'Medicina General',
            'descripcion' => 'Sirve para todo',
            'img' => '',
            'horario' => 'LUNES-MARTES-MIERCOLES-JUEVES-VIERNES|8:00-18:00'
        ]
    ];

    foreach($data as $values) {
        Especialidades::create($values);
    }


    }
};
