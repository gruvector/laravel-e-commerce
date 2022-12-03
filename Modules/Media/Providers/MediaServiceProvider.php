<?php

namespace Modules\Media\Providers;

use Illuminate\Support\Facades\View;
use Modules\Support\Traits\AddsAsset;
use Illuminate\Support\ServiceProvider;
use Modules\Admin\Http\ViewComposers\AssetsComposer;

class MediaServiceProvider extends ServiceProvider
{
    use AddsAsset;

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('media::admin.file_manager.index', AssetsComposer::class);

        $this->addAdminAssets('admin.(media|file_manager).(index|edit)', ['admin.media.css', 'admin.media.js']);
    }
}
