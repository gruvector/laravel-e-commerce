<?php

namespace Modules\Support;

use DateTimeZone;

class TimeZone
{
    /**
     * Array of all time zones.
     *
     * @var array
     */
    private static $timeZones;

    /**
     * Get all defined time zones.
     *
     * @return array
     */
    public static function all()
    {
        if (! is_null(self::$timeZones)) {
            return self::$timeZones;
        }

        $timeZones = DateTimeZone::listIdentifiers(DateTimeZone::ALL);

        return self::$timeZones = array_combine($timeZones, $timeZones);
    }
}
