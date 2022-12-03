<?php

namespace Modules\Core\Providers;

use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        if (config('app.installed')) {
            $this->mapModuleRoutes();
            $this->mapThemeRoutes();
        }
    }

    /**
     * Map routes from all enabled modules.
     *
     * @return void
     */
    private function mapModuleRoutes()
    {
        foreach ($this->app['modules']->allEnabled() as $module) {
            $this->groupRoutes("Modules\\{$module->getName()}\\Http\\Controllers", function () use ($module) {
                $this->mapAdminRoutes("{$module->getPath()}/Routes/admin.php");
                $this->mapPublicRoutes("{$module->getPath()}/Routes/public.php");
                $this->mapApiRoutes("{$module->getPath()}/Routes/api.php");
            });
        }
    }

    /**
     * Map routes from active theme.
     *
     * @return void
     */
    private function mapThemeRoutes()
    {
        $theme = $this->app['stylist']->get(setting('active_theme'));

        $this->groupRoutes("Themes\\{$theme->getName()}\\Http\\Controllers", function () use ($theme) {
            $this->mapAdminRoutes("{$theme->getPath()}/routes/admin.php");
            $this->mapPublicRoutes("{$theme->getPath()}/routes/public.php");
            $this->mapApiRoutes("{$theme->getPath()}/routes/api.php");
        });
    }

    /**
     * Group routes to common prefix and middleware.
     *
     * @param string $namespace
     * @param \Closure $callback
     * @return void
     */
    private function groupRoutes($namespace, $callback)
    {
        Route::group([
            'namespace' => $namespace,
            'prefix' => LaravelLocalization::setLocale(),
            'middleware' => ['localize', 'locale_session_redirect', 'localization_redirect', 'web'],
        ], function () use ($callback) {
            $callback();
        });
    }

    /**
     * Map admin routes.
     *
     * @return void
     */
    private function mapAdminRoutes($path)
    {
        if (! file_exists($path)) {
            return;
        }

        Route::group([
            'namespace' => 'Admin',
            'prefix' => 'admin',
            'middleware' => ['admin', 'licensed'],
        ], function () use ($path) {
            require_once $path;
        });
    }

    /**
     * Map public routes.
     *
     * @param string $path
     * @return void
     */
    private function mapPublicRoutes($path)
    {
        if (file_exists($path)) {
            require_once $path;
        }
    }

    private function mapApiRoutes($path)
    {
        if (! file_exists($path)) {
            return;
        }

        Route::group([
            'namespace' => 'Api',
            'prefix' => 'api',
            'middleware' => ['api'],
        ], function () use ($path) {
            require_once $path;
        });
    }
}
