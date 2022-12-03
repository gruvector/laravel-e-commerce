<?php

namespace Modules\Shipping\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \Illuminate\Support\Collection available()
 * @method static \Illuminate\Support\Collection all()
 * @method static array names()
 * @method static object get(string $name)
 * @method static \Modules\Shipping\ShippingMethodManager register(string $name, callable|object $driver)
 * @method static int count()
 * @method static bool isEmpty()
 * @method static bool isNotEmpty()
 *
 * @see \Modules\Shipping\ShippingMethodManager
 */
class ShippingMethod extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return \Modules\Shipping\ShippingMethodManager::class;
    }
}
