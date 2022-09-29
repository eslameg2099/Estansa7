<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Review;
use App\Events\updaterate;
use App\Models\Provider;

class updateratelistener
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
    public function handle(updaterate $event)
    {
        $provider_id = $event->review->provider_id;
        $provider = Provider::findOrFail($provider_id);
        $provider->rate = $provider->reviews->sum('rate')  / $provider->reviews->count();
        $provider->save();
    }
}
