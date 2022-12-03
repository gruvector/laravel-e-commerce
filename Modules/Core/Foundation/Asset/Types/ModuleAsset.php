<?php

namespace Modules\Core\Foundation\Asset\Types;

use Nwidart\Modules\Facades\Module;

class ModuleAsset extends Asset implements AssetType
{
    private $path;

    public function __construct($path)
    {
        $this->path = $path;
    }

    public function url()
    {
        return $this->asset(
            Module::asset($this->path)
        );
    }
}
