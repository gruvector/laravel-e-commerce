<?php

namespace Modules\Payment\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \Illuminate\Support\Collection all()
 * @method static array names()
 * @method static \Modules\Payment\GatewayInterface get(string $name)
 * @method static \Modules\Payment\GatewayManager register(string $name, callable|object $driver)
 * @method static int count()
 * @method static bool isEmpty()
 * @method static bool isNotEmpty()
 *
 * @see \Modules\Payment\GatewayManager
 */
class Gateway extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return \Modules\Payment\GatewayManager::class;
    }
}
