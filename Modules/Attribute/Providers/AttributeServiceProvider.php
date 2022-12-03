<?php

namespace Modules\Attribute\Providers;

use Modules\Support\Traits\AddsAsset;
use Illuminate\Support\ServiceProvider;
use Modules\Admin\Ui\Facades\TabManager;
use Modules\Attribute\Admin\AttributeTabs;
use Modules\Attribute\Admin\AttributeSetTabs;
use Modules\Attribute\Admin\ProductTabsExtender;

class AttributeServiceProvider extends ServiceProvider
{
    use AddsAsset;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        TabManager::register('attributes', AttributeTabs::class);
        TabManager::register('attribute_sets', AttributeSetTabs::class);
        TabManager::extend('products', ProductTabsExtender::class);

        $this->addAdminAssets('admin.(attributes|products).(create|edit)', ['admin.attribute.css', 'admin.attribute.js']);
    }
}
