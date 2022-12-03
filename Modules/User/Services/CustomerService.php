<?php

namespace Modules\User\Services;

use Modules\User\Entities\Role;
use Modules\User\Contracts\Authentication;

class CustomerService
{
    private $auth;

    public function __construct(Authentication $auth)
    {
        $this->auth = $auth;
    }

    public function register($request)
    {
        return tap($this->auth->registerAndActivate($this->getCustomerData($request)), function ($user) {
            $role = Role::find(setting('customer_role'));

            $user->roles()->attach($role);
        });
    }

    private function getCustomerData($request)
    {
        return array_merge($request->billing, [
            'email' => $request->customer_email,
            'password' => $request->password,
        ]);
    }
}
