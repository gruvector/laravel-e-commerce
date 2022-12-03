<?php

namespace Modules\User\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        \Modules\User\Events\CustomerRegistered::class => [
            \Modules\User\Listeners\SendWelcomeEmail::class,
            \Modules\User\Listeners\SendWelcomeSms::class,
        ],
    ];
}
