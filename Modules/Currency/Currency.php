<?php

namespace Modules\Currency;

class Currency
{
    /**
     * Path of the resource.
     *
     * @var string
     */
    const RESOURCE_PATH = __DIR__ . '/Resources/currencies.php';

    /**
     * Array of all currencies.
     *
     * @var array
     */
    private static $currencies;

    /**
     * Get all currencies.
     *
     * @return array
     */
    public static function all()
    {
        if (is_null(self::$currencies)) {
            self::$currencies = require self::RESOURCE_PATH;
        }

        return self::$currencies;
    }

    /**
     * Get all currency codes.
     *
     * @return array
     */
    public static function codes()
    {
        return array_keys(self::all());
    }

    /**
     * Get all currency names.
     *
     * @return array
     */
    public static function names()
    {
        return array_map(function ($currency) {
            return $currency['name'];
        }, self::all());
    }

    /**
     * Get name of the give currency code.
     *
     * @param string $code
     * @return string
     */
    public static function name($code)
    {
        return array_get(self::all(), "{$code}.name");
    }

    /**
     * Get subunit for the given currency code.
     *
     * @param string $code
     * @return int
     */
    public static function subunit($code)
    {
        return array_get(self::all(), "{$code}.subunit");
    }
}
