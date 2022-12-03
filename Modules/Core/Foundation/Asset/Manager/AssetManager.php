<?php

namespace Modules\Core\Foundation\Asset\Manager;

interface AssetManager
{
    /**
     * Add a new asset.
     *
     * @param string $dependency
     * @param string $path
     * @return void
     */
    public function addAsset($asset, $path);

    /**
     * Get all css files.
     *
     * @return \Illuminate\Support\Collection
     */
    public function allCss();

    /**
     * Get all js files.
     *
     * @return \Illuminate\Support\Collection
     */
    public function allJs();

    /**
     * Get css file for the given dependency.
     *
     * @param string $dependency
     * @return string
     *
     * @throws \Modules\Core\Foundation\Asset\AssetNotFoundException
     */
    public function getJs($dependency);

    /**
     * Get js file for the given dependency.
     *
     * @param string $dependency
     * @return string
     *
     * @throws \Modules\Core\Foundation\Asset\AssetNotFoundException
     */
    public function getCss($dependency);
}
