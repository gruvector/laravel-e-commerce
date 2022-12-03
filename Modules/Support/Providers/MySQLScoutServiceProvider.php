<?php

namespace Modules\Support\Providers;

use Laravel\Scout\EngineManager;
use Illuminate\Support\ServiceProvider;
use Modules\Support\Search\MySqlSearchEngine;

class MySQLScoutServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app[EngineManager::class]->extend('mysql', function () {
            return new MySqlSearchEngine;
        });
    }
}
