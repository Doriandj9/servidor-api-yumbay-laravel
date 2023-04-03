<?php

namespace Tests\Feature;

use Tests\TestCase;

class NewUserTest extends TestCase
{
    public function testAddNewUser() {
        $response = $this->post(
            '/add/user',
            [
                'name' => 'dorian'
            ]
        );

        
    }
}