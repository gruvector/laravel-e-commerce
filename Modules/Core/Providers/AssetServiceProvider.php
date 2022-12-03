<?php

namespace Modules\Core\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Core\Foundation\Asset\Manager\AssetManager;
use Modules\Core\Foundation\Asset\Pipeline\AssetPipeline;
use Modules\Core\Foundation\Asset\Manager\FleetCartAssetManager;
use Modules\Core\Foundation\Asset\Pipeline\FleetCartAssetPipeline;
use Modules\Core\Foundation\Asset\Types\AssetTypeFactory as AssetFactory;

class AssetServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        if (! config('app.installed')) {
            return;
        }

        $this->addThemesAssets();
        $this->addModulesAssets();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(AssetManager::class, FleetCartAssetManager::class);

        $this->app->singleton(AssetPipeline::class, function ($app) {
            return new FleetCartAssetPipeline($app[AssetManager::class]);
        });
    }

    /**
     * Add themes assets to the asset manager.
     *
     * @return void
     */
    private function addThemesAssets()
    {
        $theme = strtolower(setting('active_theme'));

        if (! is_null($assets = config("fleetcart.themes.{$theme}.assets"))) {
            $this->addAssets($assets);
        }
    }

    /**
     * Add modules assets to the asset manager.
     *
     * @return void
     */
    private function addModulesAssets()
    {
        foreach ($this->app['modules']->allEnabled() as $module) {
            $assets = config("fleetcart.modules.{$module->getAlias()}.assets");

            if (! is_null($assets)) {
                $this->addAssets($assets);
            }
        }
    }

    /**
     * Add the assets from the config file on the asset manager.
     *
     * @param array $allAssets
     * @return void
     */
    private function addAssets($assets)
    {
        // Add all assets to the AssetManager
        foreach (array_get($assets, 'all_assets', []) as $assetName => $assetPath) {
            $url = $this->app[AssetFactory::class]->make($assetPath)->url();

            $this->app[AssetManager::class]->addAsset($assetName, $url);
        }

        // Add required assets directly to the AssetPipeline
        $this->app[AssetPipeline::class]->requireAssets(array_get($assets, 'required_assets', []));
    }
}
