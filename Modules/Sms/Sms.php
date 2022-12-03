<?php

namespace Modules\Sms;

use Modules\Sms\Facades\Gateway;

class Sms
{
    public static function send($to, $message)
    {
        if (! setting('sms_service')) {
            return;
        }

        $gateway = Gateway::get(setting('sms_service'));

        $gateway->send($to, $message);
    }
}
