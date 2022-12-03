<?php

namespace Modules\Sms\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \Illuminate\Support\Collection all()
 * @method static array names()
 * @method static \Modules\Sms\GatewayInterface get(string $name)
 * @method static \Modules\Sms\GatewayManager register(string $name, callable|object $driver)
 * @method static int count()
 * @method static bool isEmpty()
 * @method static bool isNotEmpty()
 *
 * @see \Modules\Sms\GatewayManager
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
        return \Modules\Sms\GatewayManager::class;
    }
}
