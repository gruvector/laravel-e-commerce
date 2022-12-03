<?php

namespace Modules\User\Sentinel;

use Modules\User\Entities\Role;
use Modules\User\Entities\User;
use Modules\User\Contracts\Authentication;
use Cartalyst\Sentinel\Laravel\Facades\Reminder;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Modules\User\Events\UserHasActivatedAccount;
use Cartalyst\Sentinel\Laravel\Facades\Activation;

class SentinelAuthentication implements Authentication
{
    /**
     * Authenticate a user.
     *
     * @param array $credentials
     * @param bool $remember
     * @return mixed
     */
    public function login($credentials, $remember = false)
    {
        return Sentinel::authenticate($credentials, $remember);
    }

    /**
     * Register a new user.
     *
     * @param array $data
     * @return bool
     */
    public function register($data)
    {
        return Sentinel::register($data);
    }

    /**
     * Register and activate a new user.
     *
     * @param array $data
     * @return \Modules\User\Entities\User
     */
    public function registerAndActivate($data)
    {
        return Sentinel::registerAndActivate($data);
    }

    /**
     * Activate the given used id.
     *
     * @param int $userId
     * @param string $code
     * @return void
     */
    public function activate($userId, $code)
    {
        $user = Sentinel::findById($userId);

        if (Activation::complete($user, $code)) {
            event(new UserHasActivatedAccount($user));
        }
    }

    /**
     * Assign a role to the given user.
     *
     * @param \Modules\User\Entities\User $user
     * @param \Modules\User\Entities\Role $role
     * @return void
     */
    public function assignRole(User $user, Role $role)
    {
        $role->users()->attach($user);
    }

    /**
     * Log the user out of the application.
     *
     * @return bool
     */
    public function logout()
    {
        return Sentinel::logout();
    }

    /**
     * Create an activation code for the given user.
     *
     * @param \Modules\User\Entities\User $user
     * @return \Cartalyst\Sentinel\Activations\ActivationInterface
     */
    public function createActivation(User $user)
    {
        return Activation::create($user)->code;
    }

    /**
     * Create a reminders code for the given user.
     *
     * @param \Modules\User\Entities\User $user
     * @return string
     */
    public function createReminderCode(User $user)
    {
        return Reminder::create($user)->code;
    }

    /**
     * Completes the reset password process.
     *
     * @param \Modules\User\Entities\User $user
     * @param string $code
     * @param string $password
     * @return bool
     */
    public function completeResetPassword(User $user, $code, $password)
    {
        return Reminder::complete($user, $code, $password);
    }

    /**
     * Determines if the current user has access to the given permissions.
     *
     * @param array|string $permissions
     * @return bool
     */
    public function hasAccess($permissions)
    {
        if (Sentinel::guest()) {
            return false;
        }

        $permissions = is_array($permissions) ? $permissions : func_get_args();

        return Sentinel::hasAccess($permissions);
    }

    /**
     * Determine if the current user has access to the any given permissions
     *
     * @param array|string $permissions
     * @return bool
     */
    public function hasAnyAccess($permissions)
    {
        if (Sentinel::guest()) {
            return false;
        }

        $permissions = is_array($permissions) ? $permissions : func_get_args();

        return Sentinel::hasAnyAccess($permissions);
    }

    /**
     * Check if the user is logged in.
     *
     * @return bool
     */
    public function check()
    {
        return Sentinel::check();
    }

    /**
     * Get the currently logged in user.
     *
     * @return \Modules\User\Entities\User|null
     */
    public function user()
    {
        return Sentinel::getUser();
    }

    /**
     * Get the ID for the currently authenticated user.
     *
     * @return int|null
     */
    public function id()
    {
        return optional($this->user())->id;
    }
}
