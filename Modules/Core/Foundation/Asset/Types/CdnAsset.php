<?php

namespace Modules\Core\Foundation\Asset\Types;

class CdnAsset implements AssetType
{
    private $path;

    public function __construct($path)
    {
        $this->path = $path;
    }

    public function url()
    {
        return $this->path;
    }
}
