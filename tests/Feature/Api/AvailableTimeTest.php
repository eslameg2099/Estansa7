<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use App\Models\AvailableTime;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;

class AvailableTimeTest extends TestCase
{
    use RefreshDatabase;

    public function test_logged_in_user_can_see_test_add_Availables_page()
    {
        $user = User::factory()->create();
        $this->actingAs($user)
            ->get('/api/availabletime')
            ->assertStatus(200);
    }
    /** @test */
    public function test_show_Available()
    {
        $this->actingAsAdmin();
        $AvailableTime = AvailableTime::factory(['day_id' => 2])->create();
        $response = $this->getJson(route('api.availabletime.show', $AvailableTime))
            ->assertSuccessful();
        $this->assertEquals($response->json('data.day_id'), 2);
    
    }

  
    



    public function test_delete_Available()
    {
        $user = User::factory()->create();
        $AvailableTime = AvailableTime::create([
            'user_id' => $user->id,
            'from' =>'10:15:00',
            'to' => '10:15:00',
            'day_id' => 3,
        ]);
        $this->actingAs($user)->delete('/api/availabletime/'.$AvailableTime->id);
        $this->assertDatabaseCount('available_times', 0);



    }


   





}