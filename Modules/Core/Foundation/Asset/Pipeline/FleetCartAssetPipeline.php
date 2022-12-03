<?php

namespace Modules\Core\Foundation\Asset\Pipeline;

use Illuminate\Support\Collection;
use Modules\Core\Foundation\Asset\Manager\AssetManager;

class FleetCartAssetPipeline implements AssetPipeline
{
    /**
     * @var \Illuminate\Support\Collection
     */
    protected $css;

    /**
     * @var \Illuminate\Support\Collection
     */
    protected $js;

    /**
     * Create a new instance of FleetCartAssetPipeline.
     *
     * @param \Modules\Core\Foundation\Asset\Manager\AssetManager $assetManager
     */
    public function __construct(AssetManager $assetManager)
    {
        $this->css = new Collection;
        $this->js = new Collection;
        $this->assetManager = $assetManager;
    }

    /**
     * Return all css files to include.
     *
     * @return \Illuminate\Support\Collection
     */
    public function allCss()
    {
        return $this->css;
    }

    /**
     * Return all js files to include.
     *
     * @return \Illuminate\Support\Collection
     */
    public function allJs()
    {
        return $this->js;
    }

    /**
     * Require assets for the view.
     *
     * @param string|array $assets
     * @return $this
     */
    public function requireAssets($assets)
    {
        $assets = is_array($assets) ? $assets : func_get_args();

        foreach ($assets as $asset) {
            $this->addAsset($asset);
        }

        return $this;
    }

    /**
     * Add asset to css/js collection.
     *
     * @param string $asset
     * @return void
     */
    private function addAsset($asset)
    {
        $extension = pathinfo($asset, PATHINFO_EXTENSION);

        if ($extension === 'css') {
            $collection = $this->css;
            $assetPath = $this->assetManager->getCss($asset);
        } elseif ($extension === 'js') {
            $collection = $this->js;
            $assetPath = $this->assetManager->getJs($asset);
        }

        $collection->put($asset, $assetPath);
    }

    /**
     * Add an asset before another one.
     *
     * @param string $asset
     * @return void
     */
    public function before($asset)
    {
        $this->insert($asset, 'before');
    }

    /**
     * Add an asset after another one.
     *
     * @param string $asset
     * @return void
     */
    public function after($asset)
    {
        $this->insert($asset, 'after');
    }

    /**
     * Insert an asset in right order.
     *
     * @param string $asset
     * @param string $offset
     */
    private function insert($asset, $offset = 'before')
    {
        $offset = $offset === 'before' ? 0 : 1;

        list($assets, $collection) = $this->findDependenciesForKey($asset);
        list($key, $value) = $this->getLastKeyAndValueOf($assets);

        $pos = $this->getPositionInArray($asset, $assets);

        $assets = array_merge(
            array_slice($assets, 0, $pos + $offset, true),
            [$key => $value],
            array_slice($assets, $pos, count($assets) - 1, true)
        );

        $this->$collection = new Collection($assets);
    }

    /**
     * Find in which collection the given asset exists.
     *
     * @param string $asset
     * @return array
     */
    private function findDependenciesForKey($asset)
    {
        if ($this->css->get($asset)) {
            return [$this->css->all(), 'css'];
        }

        return [$this->js->all(), 'js'];
    }

    /**
     * Get the last key and value the given array.
     *
     * @param array $assets
     * @return array
     */
    private function getLastKeyAndValueOf(array $assets)
    {
        $value = end($assets);
        $key = key($assets);

        reset($assets);

        return [$key, $value];
    }

    /**
     * Return the position in the array of the given key.
     *
     * @param string $asset
     * @param array $assets
     * @return int
     */
    private function getPositionInArray($asset, array $assets)
    {
        return array_search($asset, array_keys($assets), true);
    }
}
