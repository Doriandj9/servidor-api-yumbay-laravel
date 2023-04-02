<?php

namespace Tests\Unit\Utils;

use App\Utils\TokenJWT;
use PHPUnit\Framework\TestCase;

class TokenJwtTest extends TestCase
{
    private $playload;
    protected function setUp(): void
    {
        $this->playload = [
            'user' => 'Usuario de prueba',
            'clave' => '##$&&^JJSHDSADASD',
            'permisos' => 16,
            'isAdmins' => true
        ];
    }

    public function testEncodeJsonWebToken() {
        $encodeJWT = TokenJWT::encode($this->playload);
        $this->assertIsString($encodeJWT);

        return $encodeJWT;
    }
    /**
     * @depends testEncodeJsonWebToken
     */
    public function testDecodeJsonWebToken($token) {
        $compare = TokenJWT::decode($token);

        $this->assertInstanceOf(\stdClass::class, $compare);
    }
}
