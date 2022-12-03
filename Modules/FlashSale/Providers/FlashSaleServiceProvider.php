<?php

namespace Modules\FlashSale\Providers;

use Modules\Support\Traits\AddsAsset;
use Illuminate\Support\ServiceProvider;
use Modules\Admin\Ui\Facades\TabManager;
use Modules\FlashSale\Admin\FlashSaleTabs;

class FlashSaleServiceProvider extends ServiceProvider
{
    use AddsAsset;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        TabManager::register('flash_sales', FlashSaleTabs::class);

        $this->addAdminAssets('admin.flash_sales.(create|edit)', ['admin.media.js', 'admin.flashsale.js']);
    }
}
