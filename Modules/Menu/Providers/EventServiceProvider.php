<?php

namespace Modules\Menu\Providers;

use Modules\Menu\Entities\Menu;
use Modules\Menu\Events\Listeners\CreateRootMenuItem;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        Menu::created(CreateRootMenuItem::class);
    }
}
