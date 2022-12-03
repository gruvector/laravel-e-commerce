<?php

namespace Modules\Admin\Providers;

use Modules\Admin\Ui\Facades\Form;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Modules\Support\Traits\AddsAsset;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use Modules\Admin\Http\ViewComposers\AssetsComposer;

class AdminServiceProvider extends ServiceProvider
{
    use AddsAsset;

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('admin::layout', AssetsComposer::class);
        Paginator::defaultSimpleView('admin::pagination.simple');

        $this->addAdminAssets('admin.dashboard.index', ['admin.dashboard.css', 'admin.dashboard.js']);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        AliasLoader::getInstance()->alias('Form', Form::class);
    }
}
