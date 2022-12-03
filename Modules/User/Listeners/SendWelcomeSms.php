<?php

namespace Modules\User\Listeners;

use Modules\Sms\Sms;
use Modules\User\Entities\User;
use Modules\Sms\Exceptions\SmsException;
use Modules\User\Events\CustomerRegistered;

class SendWelcomeSms
{
    /**
     * Handle the event.
     *
     * @param \Modules\User\Events\CustomerRegistered $event
     * @return void
     */
    public function handle(CustomerRegistered $event)
    {
        try {
            if (! setting('welcome_sms')) {
                return;
            }

            Sms::send(
                $event->user->phone,
                $this->message($event->user)
            );
        } catch (SmsException $e) {
            //
        }
    }

    private function message(User $user)
    {
        return trans('sms::messages.welcome', ['first_name' => $user->first_name]);
    }
}
