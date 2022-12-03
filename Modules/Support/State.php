<?php

namespace Modules\Support;

class State
{
    /**
     * Path of the resource.
     *
     * @var string
     */
    const RESOURCE_PATH = __DIR__ . '/Resources/states';

    /**
     * Array of states.
     *
     * @var array
     */
    private static $states;

    /**
     * Get all states of the given country code.
     *
     * @param string $code
     * @return array|null
     */
    public static function get($code)
    {
        if (isset(self::$states[$code])) {
            return self::$states[$code];
        }

        $path = self::RESOURCE_PATH . "/{$code}.php";

        if (file_exists($path)) {
            return self::$states[$code] = require $path;
        }
    }

    public static function name($countryCode, $stateCode)
    {
        return array_get(self::get($countryCode), $stateCode);
    }
}
