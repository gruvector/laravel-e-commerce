<?php

namespace Modules\Core\Foundation\Asset\Pipeline;

interface AssetPipeline
{
    /**
     * Return all css files to include.
     *
     * @return \Illuminate\Support\Collection
     */
    public function allCss();

    /**
     * Return all js files to include.
     *
     * @return \Illuminate\Support\Collection
     */
    public function allJs();

    /**
     * Add a javascript dependency on the view.
     *
     * @param string|array $assets
     * @return $this
     */
    public function requireAssets($assets);

    /**
     * Add an asset after another one.
     *
     * @param string $asset
     * @return void
     */
    public function after($asset);

    /**
     * Add an asset before another one.
     *
     * @param string $asset
     * @return void
     */
    public function before($asset);
}
