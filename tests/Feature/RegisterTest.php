<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegisterTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    /**
     * Test register
     */
    public function testsRegistersSuccessfully()
    {
        $payload = [
            'name' => 'Brian Okinyi',
            'email' => 'brianokinyi.bo@gmail.com',
            'password' => 'brianokinyi',
            'password_confirmation' => 'brianokinyi',
        ];

        $this->json('post', 'api/register', $payload)
            ->assertStatus(201)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'email',
                    'api_token',
                    'created_at',
                    'updated_at',
                ],
        ]);
    }

    public function testsRequiresPasswordEmailAndName()
    {
        $this->json('post', '/api/register')
            ->assertStatus(422)
            ->assertJson([
                'name' => ['The name field is required.'],
                'email' => ['The email field is required.'],
                'password' => ['The password field is required.'],
            ]);
    }

    public function testsRequirePasswordConfirmation()
    {
        $payload = [
            'name' => 'Brian Okinyi',
            'email' => 'brianokinyi.bo@gmail.com',
            'password' => 'brianokinyi',
        ];

        $this->json('post', '/api/register', $payload)
            ->assertStatus(422)
            ->assertJson([
                'password' => ['The password confirmation does not match.'],
            ]);
    }
}
