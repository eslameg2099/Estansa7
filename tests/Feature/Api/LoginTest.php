<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use App\Models\User;
use App\Support\FirebaseToken;

class LoginTest extends TestCase
{
    public function test_sanctum_login()
    {
        $user = User::factory()->create();

        $response = $this->postJson(route('api.sanctum.login'), [
            'username' => $user->phone,
            'password' => 'password',
        ]);

        $response->assertSuccessful()
            ->assertJsonStructure(['token']);

    }
}
