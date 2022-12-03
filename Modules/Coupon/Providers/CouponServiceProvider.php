<?php

namespace Modules\Coupon\Providers;

use Modules\Coupon\Admin\CouponTabs;
use Illuminate\Support\ServiceProvider;
use Modules\Admin\Ui\Facades\TabManager;

class CouponServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        TabManager::register('coupons', CouponTabs::class);
    }
}
