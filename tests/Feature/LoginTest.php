<?php

namespace Tests\Feature;

use Tests\TestCase;

class LoginTest extends TestCase
{


    public function testResponseOkApiLogin() {
        $response  = $this->post('/api/aut',[
            'cedula' => '0250186665',
            'clave' => '12345',
            'rol' => 'user:16'
        ]);

        $response->assertStatus(200);
        $response->assertJson($response->json());
    }
}
