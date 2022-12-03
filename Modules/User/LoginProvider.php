<?php

namespace Modules\User;

class LoginProvider
{
    private static $providers = ['facebook', 'google'];

    public static function add($provider)
    {
        array_push(self::$providers, $provider);

        return self::$providers;
    }

    public static function all()
    {
        return self::$providers;
    }

    public static function enabled()
    {
        return array_filter(self::$providers, function ($provider) {
            return setting("{$provider}_login_enabled");
        });
    }

    public static function isEnable($provider)
    {
        return in_array($provider, self::enabled());
    }
}
