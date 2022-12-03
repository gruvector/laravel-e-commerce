<?php

namespace Modules\Tax\Providers;

use Modules\Tax\Admin\TaxTabs;
use Modules\Support\Traits\AddsAsset;
use Illuminate\Support\ServiceProvider;
use Modules\Admin\Ui\Facades\TabManager;

class TaxServiceProvider extends ServiceProvider
{
    use AddsAsset;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        TabManager::register('tax_classes', TaxTabs::class);

        $this->addAdminAssets('admin.taxes.(create|edit)', ['admin.tax.css', 'admin.tax.js']);
    }
}
