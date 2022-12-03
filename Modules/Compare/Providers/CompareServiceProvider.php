<?php

namespace Modules\Compare\Providers;

use Modules\Compare\Compare;
use Illuminate\Support\ServiceProvider;

class CompareServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Compare::class, function ($app) {
            return new Compare(
                $app['session'],
                $app['events'],
                'compare',
                session()->getId() . '_compare',
                config('fleetcart.modules.compare.config')
            );
        });

        $this->app->alias(Compare::class, 'compare');
    }
}
