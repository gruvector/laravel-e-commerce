<?php

namespace Modules\User\Repositories;

use Nwidart\Modules\Facades\Module;

class Permission
{
    /**
     * Get the permissions from all the enabled modules.
     *
     * @return array
     */
    public static function all()
    {
        return static::getEnabledModulePermissions() + static::getActiveThemePermissions();
    }

    /**
     * Get enabled module permissions.
     *
     * @return array
     */
    private static function getEnabledModulePermissions()
    {
        $permissions = [];

        foreach (Module::allEnabled() as $module) {
            $config = config('fleetcart.modules.' . strtolower($module->getName()) . '.permissions');

            if (! is_null($config)) {
                $permissions[$module->getName()] = $config;
            }
        }

        return $permissions;
    }

    /**
     * Get active theme permissions.
     *
     * @return array
     */
    private static function getActiveThemePermissions()
    {
        $permissions = config('fleetcart.themes.' . strtolower(setting('active_theme')) . '.permissions');

        if (is_null($permissions)) {
            return [];
        }

        return [setting('active_theme') => $permissions];
    }

    /**
     * Prepare given permissions.
     *
     * @param array $permissions
     * @return string
     */
    public static function prepare(array $permissions)
    {
        $preparedPermissions = [];

        foreach ($permissions as $name => $value) {
            if (is_null($value) || is_bool($value)) {
                $preparedPermissions[$name] = $value;

                continue;
            }

            if (! is_null(static::value($value))) {
                $preparedPermissions[$name] = static::value($value);
            }
        }

        return json_encode($preparedPermissions);
    }

    /**
     * Get the permission value.
     *
     * @param $permission
     * @return bool|null
     */
    protected static function value($permission)
    {
        if ($permission === '1') {
            return true;
        }

        if ($permission === '-1') {
            return false;
        }
    }
}
