<?php

namespace Tets\Unit\Models;

use App\Models\UsuariosEspecialidades;
use Tests\TestCase;

class UsuariosEspecialidadesTest extends TestCase
{

    public function testResponseAll() {
        $data = UsuariosEspecialidades::all();

        $this->assertIsIterable($data);
    }
}