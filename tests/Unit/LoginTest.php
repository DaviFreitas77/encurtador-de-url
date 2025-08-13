<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */



    public function test_login_user(): void
    {
        User::factory()->create([
            'email' => 'davi@gmail.com',
            'password' => bcrypt('12345678'),
        ]);


        $response = $this->postJson('/api/auth/login', [
            'email' => "davi@gmail.com",
            "password" => "12345678"
        ]);


        //verifica se retorna a estrutura esperada
        $response->assertStatus(200)
            ->assertJsonStructure([
                'access_token',
                'token_type',
                'user',
            ]);
    }
}
