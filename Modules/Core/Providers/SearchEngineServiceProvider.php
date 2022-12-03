<?php

namespace Modules\Core\Providers;

use Illuminate\Support\ServiceProvider;

class SearchEngineServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (! config('app.installed')) {
            return;
        }

        $this->app['config']->set([
            'scout' => [
                'driver' => setting('search_engine', 'mysql'),
                'algolia' => [
                    'id' => setting('algolia_app_id'),
                    'secret' => setting('algolia_secret'),
                ],
            ],
        ]);
    }
}
