<?php

namespace Modules\Sms\Gateways;

use Exception;
use Vonage\Client;
use Vonage\SMS\Message\SMS;
use Modules\Sms\GatewayInterface;
use Vonage\Client\Credentials\Basic;
use Modules\Sms\Exceptions\SmsException;

class Vonage implements GatewayInterface
{
    public function client()
    {
        return new Client(
            new Basic(setting('vonage_key'), setting('vonage_secret'))
        );
    }

    public function send(string $to, string $message)
    {
        try {
            $text = new SMS($to, setting('sms_from'), $message);

            $this->client()->sms()->send($text);
        } catch (Exception $e) {
            throw new SmsException('Vonage: ' . $e->getMessage());
        }
    }
}
