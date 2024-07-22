<?php

namespace App\Providers;

use App\Events\OderShipped;
use App\Events\OrderCreated;
use App\Listeners\LogOrder;
use App\Listeners\LogOrderShipped;
use App\Listeners\SendNotification;
use App\Listeners\SendOrderNotification;
use App\Listeners\UpdateStock;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        OderShipped::class => [
            LogOrderShipped::class,
            SendNotification::class,

        ],
        OrderCreated::class => [
            SendOrderNotification::class,
            LogOrder::class,
            UpdateStock::class,

        ]
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
