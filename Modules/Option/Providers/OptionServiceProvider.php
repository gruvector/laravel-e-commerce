<?php

namespace Modules\Option\Providers;

use Modules\Option\Admin\OptionTabs;
use Modules\Support\Traits\AddsAsset;
use Illuminate\Support\ServiceProvider;
use Modules\Admin\Ui\Facades\TabManager;
use Modules\Option\Admin\ProductTabsExtender;

class OptionServiceProvider extends ServiceProvider
{
    use AddsAsset;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        TabManager::register('options', OptionTabs::class);
        TabManager::extend('products', ProductTabsExtender::class);

        $this->addAdminAssets('admin.(options|products).(create|edit)', ['admin.option.css', 'admin.option.js']);
    }
}
