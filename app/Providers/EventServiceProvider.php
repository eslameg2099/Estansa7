<?php

namespace App\Providers;

use App\Models\Customer;
use Illuminate\Auth\Events\Registered;
use App\Observers\PhoneVerificationObserver;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use App\Observers\AttachCategoryToUserObserver;
use App\Models\User;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        \App\Events\FeedbackSent::class => [
            \App\Listeners\SendFeedbackMessage::class,
        ],
        \App\Events\VerificationCreated::class => [
            \App\Listeners\SendVerificationCode::class,
        ],
        \App\Events\updateavailable_times::class => [
            \App\Listeners\updateavailable_time::class,
        ],
        \App\Events\updaterate::class => [
            \App\Listeners\updateratelistener::class,
        ],
    ];


    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        Customer::observe(PhoneVerificationObserver::class);
        User::observe(AttachCategoryToUserObserver::class);

    }
}
