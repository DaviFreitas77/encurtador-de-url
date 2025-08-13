<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class fluxoUserTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_fluxo_user(): void
    {
        $response = $this->postJson('/api/auth/register', [
            'name' => 'davi freitas',
            'email' => 'davifreitas@gmail.com',
            'password' => '12345678'
        ]);
        $response->assertStatus(201);

        $response = $this->postJson('/api/auth/login', [
            "email" => 'davifreitas@gmail.com',
            "password" => '12345678'
        ]);
        $response->assertStatus(200);
        $token = $response['access_token'];

        $response = $this->withHeaders([
            'Authorization' => 'Bearer' . $token,
        ])->postJson('/api/links', [
            'original_url' => 'https://www.youtube.com/',
            'expires_at' => null,
        ]);
        $response->assertStatus(201);

        $response = $this->withHeaders([
            'Authorization' => 'Bearer' . $token,
        ])->getJson('/api/links');
        $response->assertStatus(200);
    }
}
