<?php

namespace Modules\Slider\Providers;

use Modules\Slider\Admin\SliderTabs;
use Modules\Support\Traits\AddsAsset;
use Illuminate\Support\ServiceProvider;
use Modules\Admin\Ui\Facades\TabManager;

class SliderServiceProvider extends ServiceProvider
{
    use AddsAsset;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        TabManager::register('sliders', SliderTabs::class);

        $this->addAdminAssets('admin.sliders.(create|edit)', ['admin.media.js', 'admin.slider.css', 'admin.slider.js']);
    }
}
