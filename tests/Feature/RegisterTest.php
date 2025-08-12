<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_register_user(): void
    {
        $response = $this->postJson('/api/auth/register',[
            'name'=>"davi",
            "email"=>"davi@gmail.com",
            "password"=>"12345678"
        ]);

        $response->assertStatus(201);
    }
}
