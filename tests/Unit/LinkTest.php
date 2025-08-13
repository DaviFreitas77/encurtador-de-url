<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LinkTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {

        $user =  User::factory()->create([
            'email' => "davi@gmail.com",
            'password' => bcrypt('12345678')
        ]);

        $response = $this->actingAs($user, 'sanctum')->postJson('/api/links', [
            'original_url' => 'https://www.youtube.com/',
            'expires_at' => null,
        ]);



        $response->assertStatus(201);
    }
}
