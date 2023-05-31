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
            'descripcion' => 'Se dedica al estudio de los dientes y las encías y al tratamiento de sus dolencias.',
            'img' => '/imgs/cuidado-dental.png'
        ],
        [
            'nombre' => 'Medicna general',
            'descripcion' => 'Constituye el primer nivel de atención médica y es imprescindible para la prevención, detección, tratamiento y seguimiento de las enfermedades crónicas estabilizadas, responsabilizándose del paciente en su conjunto.',
            'img' => '/imgs/undraw_medicine_b-1-ol.svg'
        ],
        [
            'nombre' => 'Atención pediátrica',
            'descripcion' => 'Se ocupa del estudio del crecimiento y el desarrollo de los niños hasta la adolescencia, así como del tratamiento de sus enfermedades.',
            'img' => '/imgs/undraw_true_friends_c-94-g.svg'
        ],
        [
            'nombre' => 'Ginecología',
            'descripcion' => 'Estudia y trata todo lo relacionado con el aparato reproductorio, útero y ovarios de la mujer, tiene una especialidad que es la obstetricia que se encarga del embarazo, el parto y el puerperio (que es el periodo posterior al parto).',
            'img' => '/imgs/examen-pelvico.png'
        ],
        [
            'nombre' => 'Fisioterapia',
            'descripcion' => 'Ofrece un tratamiento terapéutico y de rehabilitación no farmacológica para diagnosticar, prevenir y tratar síntomas de múltiples dolencias, tanto agudas como crónicas, por medio de agentes físicos como la electricidad, ultrasonido, láser, calor, frío, agua, técnicas manuales como estiramientos, tracciones, masajes.',
            'img' => '/imgs/terapia-fisica.png'
        ],
        [
            'nombre' => 'Otorrinolaringología',
            'descripcion' => 'Se ocupa de las funciones propias de estas áreas, como la respiración, la olfacción, la deglución, el habla y la voz y también de las estructuras faciales y cervicales que participan en ellas.',
            'img' => '/imgs/otoscopio.png'
        ],
        [
            'nombre' => 'Audiología',
            'descripcion' => 'Se encarga de estudiar y diagnosticar patologías de la audición y el oído; además también de la prevención, detección y tratamiento de sordera.',
            'img' => '/imgs/oido.png'
        ],

    ];

    foreach($data as $values) {
        Especialidades::create($values);
    }
    }
};
