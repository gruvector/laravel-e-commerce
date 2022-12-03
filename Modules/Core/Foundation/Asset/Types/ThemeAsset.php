<?php

namespace Modules\Core\Foundation\Asset\Types;

use Theme;

class ThemeAsset extends Asset implements AssetType
{
    private $path;

    public function __construct($path)
    {
        $this->path = $path;
    }

    public function url()
    {
        return $this->asset(
            Theme::url($this->path)
        );
    }
}
