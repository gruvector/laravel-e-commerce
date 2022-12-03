<?php

namespace Modules\Setting\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        \Modules\Setting\Events\SettingSaved::class => [
            \Modules\Setting\Listeners\ClearSettingCache::class,
        ],
    ];
}
