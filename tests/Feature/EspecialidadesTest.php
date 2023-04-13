<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EspecialidadesTest extends TestCase
{
    use RefreshDatabase;

    private $data;

    protected function setUp(): void
    {
        parent::setUp();
        $file = fopen(__DIR__ . '/public/imgs/cuidado-dental.png','r');
        $this->data = [
            'nombre' => 'Pediatria',
            'descripcion' => 'Es una para los ninos',
            'multipart' => [
                [
                    'name' => 'imagen',
                    'contents' => fread($file,filesize(__DIR__ . '/public/imgs/cuidado-dental.png')),
                ],
            ],
            'horario' => 'LUNES-MARTES-MIERCOLES|8:00-15:00'
        ];
        fclose($file);
    }


    public function testAddNewEspecialidad(){

        $response = $this->post('/api/add/especialidades',$this->data);

        $response->assertOk();

    }
}
