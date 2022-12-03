<?php

namespace Modules\Support\Traits;

use Modules\Core\Events\CollectingAssets;

trait AddsAsset
{
    /**
     * Add assets for admin panel.
     *
     * @param array|string $routes
     * @param array $assets
     * @return void
     */
    public function addAdminAssets($routes, array $assets)
    {
        if (config('app.installed') && $this->app['inAdminPanel']) {
            $this->addAssets($routes, $assets);
        }
    }

    /**
     * Add given assets to the given routes response.
     *
     * @param array|string $routes
     * @param array $assets
     * @return void
     */
    public function addAssets($routes, array $assets)
    {
        $this->app['events']->listen(CollectingAssets::class, function (CollectingAssets $event) use ($routes, $assets) {
            if ($event->onRoutes(array_wrap($routes))) {
                $event->requireAssets($assets);
            }
        });
    }
}
