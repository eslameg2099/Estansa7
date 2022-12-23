<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use App\Events\VerificationCreated;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Storage;
use App\Models\CategoryProvider;


class RegisterTest extends TestCase
{
    public function test_customer_register_validation()
    {
        $this->postJson(route('api.sanctum.register'), [])
            ->assertJsonValidationErrors(['name', 'email', 'phone', 'password']);

        $this->postJson(route('api.sanctum.register'), [
            'name' => 'User',
            'email' => 'user.demo.com',
            'phone' => '123456',
            'type' => User::CUSTOMER_TYPE,
            'avatar' => UploadedFile::fake()->create('file.pdf'),
            'password' => 'password',
            'password_confirmation' => '123456',
        ])
            ->assertJsonValidationErrors(['email', 'password', 'avatar']);
    }


    public function test_customer_register()
    {
        Storage::fake('avatars');

        $response = $this->postJson(route('api.sanctum.register'), [
            'name' => 'User',
            'email' => 'user12@demo.com',
            'phone' => '123456',
            'password' => 'password',
            'type' => User::CUSTOMER_TYPE,
            'password_confirmation' => 'password',
            'avatar' => UploadedFile::fake()->image('avatar.jpg'),
        ]);
      //  $response->assertStatus("Response is: " . $response->getContent());

        $response->assertSuccessful();
        $user = User::all()->last();
        $this->assertEquals($user->name, 'User');

    }
    

    public function test_provoder()
    {
        Storage::fake('avatars');

        $response = $this->postJson(route('api.sanctum.register'), [
            'name' => 'provoder',
            'email' => 'user12@demo.com',
            'phone' => '123456',
            'password' => 'password',
            'type' => User::Provider_TYPE,
            'password_confirmation' => 'password',
            'avatar' => UploadedFile::fake()->image('avatar.jpg'),
            'bio'=> '123456' ,
            'cv'=> UploadedFile::fake()->image('avatar.jpg'),
            'linkedin' => '123456' ,
            'skills'=> '123456' ,
            'category_id'=> CategoryProvider::factory()->create()->id,
            'unit_price'=>4,
            'experience'=>3,


        ]);
     //   $response->assertStatus("Response is: " . $response->getContent());

        $response->assertSuccessful();
        $user = User::all()->last();
        $this->assertEquals($user->name, 'provoder');
    }
   
}
