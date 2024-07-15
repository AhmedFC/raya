<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase, WithFaker;



    public function test_user_can_login()
    {
        $user = User::create([
            'email' => 'test@example.com',
            'password' => bcrypt('password123'),
            'name' => "test",
            'type' => "admin",
            'phone' => "01022524741",
        ]);

        $response = $this->actingAs($user)
        ->withSession(['_token' => 'your-csrf-token'])
        ->post('/admin/login', [
            'email' => 'test@example.com',
            'password' => 'password123',
        ]);

$this->assertAuthenticatedAs($user);
    }
}
