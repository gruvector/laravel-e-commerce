<?php

namespace Modules\User\Listeners;

use Swift_TransportException;
use Modules\User\Mail\Welcome;
use Illuminate\Support\Facades\Mail;
use Modules\User\Events\CustomerRegistered;

class SendWelcomeEmail
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
            if (! setting('welcome_email')) {
                return;
            }

            Mail::to($event->user->email)
                ->send(new Welcome($event->user->first_name));
        } catch (Swift_TransportException $e) {
            //
        }
    }
}
