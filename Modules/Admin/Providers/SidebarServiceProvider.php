<?php

namespace Modules\Admin\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Maatwebsite\Sidebar\SidebarManager;
use Modules\Admin\Sidebar\AdminSidebar;
use Modules\Admin\Http\ViewCreators\AdminSidebarCreator;

class SidebarServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(SidebarManager $manager)
    {
        if (! config('app.installed')) {
            return;
        }

        if ($this->app['inAdminPanel']) {
            $manager->register(AdminSidebar::class);
        }

        View::creator('admin::partials.sidebar', AdminSidebarCreator::class);
    }
}
