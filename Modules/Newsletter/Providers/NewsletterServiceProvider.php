<?php

namespace Modules\Newsletter\Providers;

use Illuminate\Support\ServiceProvider;

class NewsletterServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        if (config('app.installed')) {
            $this->app['config']->set('newsletter.apiKey', setting('mailchimp_api_key'));
            $this->app['config']->set('newsletter.lists.subscribers.id', setting('mailchimp_list_id'));
        }
    }
}
