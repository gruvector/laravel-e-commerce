<?php

namespace Modules\Setting\Providers;

use Modules\Support\Traits\AddsAsset;
use Modules\Setting\Admin\SettingTabs;
use Illuminate\Support\ServiceProvider;
use Modules\Admin\Ui\Facades\TabManager;

class SettingServiceProvider extends ServiceProvider
{
    use AddsAsset;

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        TabManager::register('settings', SettingTabs::class);

        $this->addAdminAssets('admin.settings.edit', ['admin.setting.js']);
    }
}
