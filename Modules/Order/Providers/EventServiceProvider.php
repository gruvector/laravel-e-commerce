<?php

namespace Modules\Order\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        \Modules\Order\Events\OrderStatusChanged::class => [
            \Modules\Order\Listeners\SendOrderStatusChangedEmail::class,
            \Modules\Order\Listeners\SendOrderStatusChangedSms::class,
        ],
    ];
}
