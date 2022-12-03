<?php

namespace Modules\Brand\Providers;

use Modules\Brand\Admin\BrandTabs;
use Modules\Support\Traits\AddsAsset;
use Illuminate\Support\ServiceProvider;
use Modules\Admin\Ui\Facades\TabManager;

class BrandServiceProvider extends ServiceProvider
{
    use AddsAsset;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        TabManager::register('brands', BrandTabs::class);

        $this->addAdminAssets('admin.brands.(create|edit)', [
            'admin.media.css', 'admin.media.js', 'admin.brand.js',
        ]);
    }
}
