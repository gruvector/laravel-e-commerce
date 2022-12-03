<?php

namespace Modules\Core\Foundation\Asset\Manager;

use Illuminate\Support\Collection;
use Modules\Core\Foundation\Asset\AssetNotFoundException;

class FleetCartAssetManager implements AssetManager
{
    /**
     * @var array
     */
    protected $css = [];

    /**
     * @var array
     */
    protected $js = [];

    /**
     * Create new instance of FleetCartAssetManager.
     *
     * @return void
     */
    public function __construct()
    {
        $this->css = new Collection;
        $this->js = new Collection;
    }

    /**
     * Add a new asset.
     *
     * @param string $dependency
     * @param string $path
     * @return void
     */
    public function addAsset($asset, $path)
    {
        $extension = pathinfo($path, PATHINFO_EXTENSION);

        if ($extension === 'css') {
            $collection = $this->css;
        } elseif ($extension === 'js') {
            $collection = $this->js;
        }

        $collection->put($asset, $path);
    }

    /**
     * Get all css files.
     *
     * @return \Illuminate\Support\Collection
     */
    public function allCss()
    {
        return $this->css;
    }

    /**
     * Get all js files.
     *
     * @return \Illuminate\Support\Collection
     */
    public function allJs()
    {
        return $this->js;
    }

    /**
     * Get css file for the given dependency.
     *
     * @param string $dependency
     * @return string
     *
     * @throws \Modules\Core\Foundation\Asset\AssetNotFoundException
     */
    public function getCss($dependency)
    {
        return tap($this->css->get($dependency), function ($asset) use ($dependency) {
            if (is_null($asset)) {
                throw AssetNotFoundException::make($dependency);
            }
        });
    }

    /**
     * Get js file for the given dependency.
     *
     * @param string $dependency
     * @return string
     *
     * @throws \Modules\Core\Foundation\Asset\AssetNotFoundException
     */
    public function getJs($dependency)
    {
        return tap($this->js->get($dependency), function ($asset) use ($dependency) {
            if (is_null($asset)) {
                throw AssetNotFoundException::make($dependency);
            }
        });
    }
}
