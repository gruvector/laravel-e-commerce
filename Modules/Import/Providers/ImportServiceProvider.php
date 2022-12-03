<?php

namespace Modules\Import\Providers;

use Modules\Support\Traits\AddsAsset;
use Illuminate\Support\ServiceProvider;

class ImportServiceProvider extends ServiceProvider
{
    use AddsAsset;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->addAdminAssets('admin.importer.index', ['admin.import.js']);
    }
}
