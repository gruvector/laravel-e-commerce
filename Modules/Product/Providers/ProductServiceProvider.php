<?php

namespace Modules\Product\Providers;

use Modules\Product\RecentlyViewed;
use Modules\Support\Traits\AddsAsset;
use Modules\Product\Admin\ProductTabs;
use Illuminate\Support\ServiceProvider;
use Modules\Admin\Ui\Facades\TabManager;

class ProductServiceProvider extends ServiceProvider
{
    use AddsAsset;

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        TabManager::register('products', ProductTabs::class);

        $this->addAdminAssets('admin.products.(create|edit)', [
            'admin.media.css', 'admin.media.js', 'admin.product.css', 'admin.product.js',
        ]);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(RecentlyViewed::class, function ($app) {
            return new RecentlyViewed(
                $app['session'],
                $app['events'],
                'recently_viewed',
                session()->getId() . '_recently_viewed',
                config('fleetcart.modules.product.config.recently_viewed')
            );
        });

        $this->app->alias(RecentlyViewed::class, 'recently_viewed');
    }
}
