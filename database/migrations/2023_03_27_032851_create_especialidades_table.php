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
            'img' => ''
        ],
        [
            'nombre' => 'Medicina General',
            'descripcion' => 'Sirve para todo',
            'img' => ''
        ]
    ];

    foreach($data as $values) {
        Especialidades::create($values);
    }


    }
};
