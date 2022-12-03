<?php

namespace Modules\Support;

class Locale
{
    /**
     * Path of the resource.
     *
     * @var string
     */
    const RESOURCE_PATH = __DIR__ . '/Resources/locales.php';

    /**
     * Array of all locales.
     *
     * @var array
     */
    private static $locales;

    /**
     * Get all locales.
     *
     * @return array
     */
    public static function all()
    {
        if (is_null(self::$locales)) {
            self::$locales = require self::RESOURCE_PATH;
        }

        return self::$locales;
    }

    /**
     * Get all locale codes.
     *
     * @return void
     */
    public static function codes()
    {
        return array_keys(static::all());
    }

    /**
     * Get name of the given locale code.
     *
     * @param string $code
     * @return string
     */
    public static function name($code)
    {
        return array_get(static::all(), $code);
    }
}
