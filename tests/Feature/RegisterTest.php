<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    public function test_basic_assert(): void 
    {
        $response = $this->post('/api/register', [
            'name' => 'User',
            'email' => 'user@gmail.com',
            'password' => 'password123',
        ]);

        $response->assertStatus(201)
            ->assertSeeText('Usuario user@gmail.com registrado');
    }

    public function test_invalid_email(): void 
    {
        $response = $this->post('/api/register', [
            'name' => 'User',
            'email' => 'usuario-gmail.com',
            'password' => 'password123',
        ]);

        $response->assertStatus(400)->assertJson([
            "email" => [
                "El campo email debe ser un correo electronico valido"
            ]
        ]);
    }
}