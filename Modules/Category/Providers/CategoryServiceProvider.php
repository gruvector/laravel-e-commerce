<?php

namespace Modules\Category\Providers;

use Modules\Support\Traits\AddsAsset;
use Illuminate\Support\ServiceProvider;

class CategoryServiceProvider extends ServiceProvider
{
    use AddsAsset;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->addAdminAssets('admin.categories.index', [
            'admin.category.css', 'admin.jstree.js', 'admin.category.js',
            'admin.media.css', 'admin.media.js',
        ]);
    }
}
