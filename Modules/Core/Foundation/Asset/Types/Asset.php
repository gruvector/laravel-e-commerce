<?php

namespace Modules\Core\Foundation\Asset\Types;

use Illuminate\Support\Facades\File;

abstract class Asset
{
    protected function asset($url)
    {
        list($dirname, $name, $extension) = $this->parse($url);

        $url = "{$dirname}/{$name}";

        if ($extension === 'css' && is_rtl()) {
            $url .= '.rtl';
        }

        return "{$url}.{$extension}";
    }

    private function parse($url)
    {
        return [
            File::dirname($url),
            File::name($url),
            File::extension($url),
        ];
    }
}
