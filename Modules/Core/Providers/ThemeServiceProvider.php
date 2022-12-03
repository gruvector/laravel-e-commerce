<?php

namespace Modules\Core\Providers;

use Mehedi\Stylist\Theme\Json;
use Mehedi\Stylist\Theme\Theme;
use Illuminate\Support\ServiceProvider;

class ThemeServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (! config('app.installed')) {
            return;
        }

        $activeTheme = setting('active_theme');

        if (is_null($activeTheme)) {
            return;
        }

        $this->app['stylist']->activate($activeTheme);

        $this->bootTheme($this->app['stylist']->get($activeTheme));
    }

    /**
     * Boot the given theme.
     *
     * @param \Mehedi\Stylist\Theme\Theme $theme
     * @return void
     */
    private function bootTheme(Theme $theme)
    {
        $themeJson = new Json($theme->getPath());

        $providers = $themeJson->getJsonAttribute('providers') ?? [];
        $themeAlias = $themeJson->getJsonAttribute('alias');
        $files = $themeJson->getJsonAttribute('files') ?? [];

        $this->registerProviders($providers);
        $this->loadTranslations($theme, $themeAlias);
        $this->loadConfigs($theme, $themeAlias);
        $this->requireFiles($theme, $files);
    }

    /**
     * Register given service providers.
     *
     * @param array $providers
     * @return void
     */
    private function registerProviders($providers = [])
    {
        foreach ($providers as $provider) {
            $this->app->register($provider);
        }
    }

    /**
     * Load translations for the given theme.
     *
     * @param string $themeAlias
     * @param \Mehedi\Stylist\Theme\Theme $theme
     * @return void
     */
    private function loadTranslations(Theme $theme, $themeAlias)
    {
        $this->loadTranslationsFrom("{$theme->getPath()}/resources/lang", $themeAlias);
    }

    /**
     * Load configs for the given theme.
     *
     * @param string $themeAlias
     * @param \Mehedi\Stylist\Theme\Theme $theme
     * @return void
     */
    private function loadConfigs(Theme $theme, $themeAlias)
    {
        collect([
            'config' => "{$theme->getPath()}/config/config.php",
            'assets' => "{$theme->getPath()}/config/assets.php",
            'permissions' => "{$theme->getPath()}/config/permissions.php",
        ])->filter(function ($path) {
            return file_exists($path);
        })->each(function ($path, $filename) use ($themeAlias) {
            $this->mergeConfigFrom($path, "fleetcart.themes.{$themeAlias}.{$filename}");
        });
    }

    /**
     * Require the given files.
     *
     * @param \Mehedi\Stylist\Theme\Theme $theme
     * @param array $files
     * @return void
     */
    private function requireFiles(Theme $theme, $files = [])
    {
        foreach ($files as $file) {
            require_once "{$theme->getPath()}/{$file}";
        }
    }
}
