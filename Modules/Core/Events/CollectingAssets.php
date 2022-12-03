<?php

namespace Modules\Core\Events;

use Modules\Core\Foundation\Asset\Pipeline\AssetPipeline;

class CollectingAssets
{
    /**
     * Asset pipeline instance.
     *
     * @var \Modules\Core\Foundation\Asset\Pipeline\AssetPipeline
     */
    private $assetPipeline;

    /**
     * Create a new event instance.
     *
     * @param \Modules\Core\Foundation\Asset\Pipeline\AssetPipeline $assetPipeline
     */
    public function __construct(AssetPipeline $assetPipeline)
    {
        $this->assetPipeline = $assetPipeline;
    }

    /**
     * Determine if the current route name is any of the given routes.
     *
     * @param array $routes
     * @return bool
     */
    public function onRoutes(array $routes)
    {
        foreach ($routes as $route) {
            if (preg_match("/{$route}/", request()->route()->getName())) {
                return true;
            }
        }

        return false;
    }

    /**
     * Require assets to the asset pipeline.
     *
     * @param array $assets
     */
    public function requireAssets(array $assets)
    {
        return $this->assetPipeline->requireAssets($assets);
    }
}
