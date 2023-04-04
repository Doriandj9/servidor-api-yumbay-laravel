<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NewUserTest extends TestCase
{
    use RefreshDatabase;
    private $data;
    public function setUp(): void
    {
        parent::setUp();
        $this->data = [
            'cedula' => '0250186668',
            'nombres' => 'Prueba 1',
            'apellidos' => 'Prueba Apellidos',
            'direccion' => 'Av. Prueba',
            'celular' => '098554890',
            'especialidades' => '1,2',
            'telefono' => '224556',
            'correo' => 'dorian@gmail.com',
            'titulo' => 'Doctor',
            'horario' => 'Lunes',
            'numero_emergencia' => '098996054',
        ];
    }
    public function testAddNewUser() {
        $response = $this->post('/api/add/user/medico',$this->data);

        $response->assertCreated();

        $this->assertTrue(boolval($response->json('ident')));


    }
}
