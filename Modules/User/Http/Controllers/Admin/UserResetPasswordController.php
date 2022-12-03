<?php

namespace Modules\User\Http\Controllers\Admin;

use Modules\User\Entities\User;
use Illuminate\Support\Facades\Mail;
use Modules\User\Mail\ResetPasswordEmail;
use Modules\User\Contracts\Authentication;

class UserResetPasswordController
{
    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store($id, Authentication $auth)
    {
        $user = User::findOrFail($id);

        $code = $auth->createReminderCode($user);

        Mail::to($user)
            ->send(new ResetPasswordEmail($user, $this->getResetCompleteURL($user, $code)));

        return redirect()->route('admin.users.index')
            ->withSuccess(trans('user::messages.users.reset_password_email_sent'));
    }

    private function getResetCompleteURL($user, $code)
    {
        return route('admin.reset.complete', [$user->email, $code]);
    }
}
