<?php

namespace Modules\User\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Modules\Media\Entities\File;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ResetPasswordEmail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * The user entity.
     *
     * @var \Modules\User\Entities\User
     */
    public $user;

    /**
     * Reset complete form url.
     *
     * @var string
     */
    public $url;

    /**
     * Create a new instance.
     *
     * @param \Modules\User\Entities\User $user
     * @param string $url
     *
     * @return void
     */
    public function __construct($user, $url)
    {
        $this->user = $user;
        $this->url = $url;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject(trans('user::mail.reset_your_account_password'))
            ->view("emails.{$this->getViewName()}", [
                'logo' => File::findOrNew(setting('storefront_mail_logo'))->path,
            ]);
    }

    private function getViewName()
    {
        return 'reset_password' . (is_rtl() ? '_rtl' : '');
    }
}
