<?php

namespace Modules\Cart\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        \Modules\Checkout\Events\OrderPlaced::class => [
            \Modules\Cart\Listeners\ClearCart::class,
        ],
    ];
}
