<?php

namespace Tets\Unit\Models;

use App\Models\Usuarios;
use Tests\TestCase;

class UsuariosTest extends TestCase
{

    protected function setUp(): void
    {
        parent::setUp();
    }

    /**
     *
     */
    public function testDoctorWhitEspecialidades(){
        $data = Usuarios::allWhitEspecialidades('');

        $this->assertIsIterable($data);
    }
}
