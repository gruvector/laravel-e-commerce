<?php

namespace Modules\Sms\Providers;

use Modules\Sms\Facades\Gateway;
use Modules\Sms\Gateways\Twilio;
use Modules\Sms\Gateways\Vonage;
use Illuminate\Support\ServiceProvider;

class SmsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        if (! config('app.installed')) {
            return;
        }

        Gateway::register('vonage', new Vonage);
        Gateway::register('twilio', new Twilio);
    }
}
