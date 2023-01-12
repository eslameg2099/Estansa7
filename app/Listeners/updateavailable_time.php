<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\availabletime;
use App\Events\updateavailable_times;

class updateavailable_time
{

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
       
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(updateavailable_times $event)
    {
        $event->availabletime->booked_up = '1';
        $event->availabletime->save();
    }
}
