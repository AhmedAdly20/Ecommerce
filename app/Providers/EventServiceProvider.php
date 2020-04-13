<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'cart.added' => [
            'App\Listeners\CartUpdatedlistener',
        ],
        'cart.updated' => [
            'App\Listeners\CartUpdatedlistener',
        ],
        'cart.removed' => [
            'App\Listeners\CartUpdatedlistener',
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

        //
    }
}
