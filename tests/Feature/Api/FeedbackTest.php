<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use App\Models\Feedback;
use App\Events\FeedbackSent;
use Illuminate\Support\Facades\Event;

class FeedbackTest extends TestCase
{
    /** @test */
   public function test_send_feedback()
   {
    $this->postJson(route('api.feedback.send'), [
        'name' => 'User',
        'email' => 'user@demo.com',
        'phone' => '123456',
        'message' => 'something ...',
    ])->assertSuccessful();

    $Feedback = Feedback::all()->last();

    $this->assertEquals($Feedback->name,'User');
   }
}
