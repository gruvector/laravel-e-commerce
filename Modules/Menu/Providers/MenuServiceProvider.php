<?php

namespace Modules\Menu\Providers;

use Modules\Menu\Admin\MenuItemTabs;
use Modules\Support\Traits\AddsAsset;
use Illuminate\Support\ServiceProvider;
use Modules\Admin\Ui\Facades\TabManager;

class MenuServiceProvider extends ServiceProvider
{
    use AddsAsset;

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        TabManager::register('menu_items', MenuItemTabs::class);

        $this->addAdminAssets('admin.menus.(create|edit)', ['admin.menu.css', 'admin.menu.js']);
        $this->addAdminAssets('admin.menus.items.(create|edit)', ['admin.media.css', 'admin.media.js', 'admin.menu.js']);
    }
}
