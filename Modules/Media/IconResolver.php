<?php

namespace Modules\Media;

class IconResolver
{
    /**
     * The icon lookup table.
     *
     * @var array
     */
    private static $icons = [
        'image' => 'fa-picture-o',
        'audio' => 'fa-file-video-o',
        'video' => 'fa-file-video-o',
        'pdf' => 'fa-file-pdf-o',
        'zip' => 'fa-file-archive-o',
        'vnd.rar' => 'fa-file-archive-o',
        'x-tar' => 'fa-file-archive-o',
        'gzip' => 'fa-file-archive-o',
        'x-bzip' => 'fa-file-archive-o',
        'x-7z-compressed' => 'fa-file-archive-o',
        'file' => 'fa-file-o',
    ];

    /**
     * Resolve icon for the given mime type.
     *
     * @param string $mime
     * @return string
     */
    public static function resolve($mime)
    {
        if (is_null($mime)) {
            return static::$icons['file'];
        }

        list($firstHint, $secondHint) = explode('/', $mime);

        if (array_key_exists($firstHint, static::$icons)) {
            return static::$icons[$firstHint];
        }

        if (array_key_exists($secondHint, static::$icons)) {
            return static::$icons[$secondHint];
        }

        return static::$icons['file'];
    }
}
