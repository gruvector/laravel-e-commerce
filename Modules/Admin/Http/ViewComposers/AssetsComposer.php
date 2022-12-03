<?php

namespace Modules\Admin\Http\ViewComposers;

use Modules\Core\Events\CollectingAssets;
use Modules\Core\Foundation\Asset\Pipeline\AssetPipeline;

class AssetsComposer
{
    /**
     * The instance of AssetPipeline.
     *
     * @var \Modules\Core\Foundation\Asset\Pipeline\AssetPipeline
     */
    private $assetPipeline;

    /**
     * Create a new composer instance.
     *
     * @param \Modules\Core\Foundation\Asset\Pipeline\AssetPipeline $assetPipeline
     */
    public function __construct(AssetPipeline $assetPipeline)
    {
        $this->assetPipeline = $assetPipeline;
    }

    /**
     * Bind data to the view.
     *
     * @param \Illuminate\View\View $view
     * @return void
     */
    public function compose($view)
    {
        event(new CollectingAssets($this->assetPipeline));

        $view->with('assets', $this->assetPipeline);
    }
}
