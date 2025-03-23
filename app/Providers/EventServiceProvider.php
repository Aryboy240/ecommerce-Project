<?php
/**
 * EventServiceProvider for registering application events and listeners
 * 
 * Modified by: Vatsal
 * Student code: 220408633
 * Added order status change event handling
 */

namespace App\Providers;

use App\Events\OrderStatusChanged;
use App\Listeners\HandleOrderStatusChange;
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
        OrderStatusChanged::class => [
            HandleOrderStatusChange::class,
        ],
        // Add any other events and listeners here
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