<?php

namespace Modules\User\Providers;

use Illuminate\Support\ServiceProvider;

class SocialLoginServiceProvider extends ServiceProvider
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

        $this->setupFacebook();
        $this->setupGoogle();
    }

    private function setupFacebook()
    {
        $this->app['config']->set('services.facebook', [
            'client_id' => setting('facebook_login_app_id'),
            'client_secret' => setting('facebook_login_app_secret'),
            'redirect' => url('login/facebook/callback'),
        ]);
    }

    private function setupGoogle()
    {
        $this->app['config']->set('services.google', [
            'client_id' => setting('google_login_client_id'),
            'client_secret' => setting('google_login_client_secret'),
            'redirect' => url('login/google/callback'),
        ]);
    }
}
