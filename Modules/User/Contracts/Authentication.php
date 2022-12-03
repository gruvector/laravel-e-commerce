<?php

namespace Modules\User\Contracts;

use Modules\User\Entities\Role;
use Modules\User\Entities\User;

interface Authentication
{
    /**
     * Authenticate a user.
     *
     * @param array $credentials
     * @param bool $remember
     * @return mixed
     */
    public function login($credentials, $remember = false);

    /**
     * Register a new user.
     *
     * @param array $data
     * @return bool
     */
    public function register($data);

    /**
     * Register and activate a new user.
     *
     * @param array $data
     * @return \Modules\User\Entities\User
     */
    public function registerAndActivate($data);

    /**
     * Activate the given used id.
     *
     * @param int $userId
     * @param string $code
     * @return mixed
     */
    public function activate($userId, $code);

    /**
     * Assign a role to the given user.
     *
     * @param \Modules\User\Entities\User $user
     * @param \Modules\User\Entities\Role $role
     * @return void
     */
    public function assignRole(User $user, Role $role);

    /**
     * Log the user out of the application.
     *
     * @return bool
     */
    public function logout();

    /**
     * Create an activation code for the given user.
     *
     * @param \Modules\User\Entities\User $user
     * @return \Cartalyst\Sentinel\Activations\ActivationInterface
     */
    public function createActivation(User $user);

    /**
     * Create a reminders code for the given user.
     *
     * @param \Modules\User\Entities\User $user
     * @return string
     */
    public function createReminderCode(User $user);

    /**
     * Completes the reset password process.
     *
     * @param \Modules\User\Entities\User $user
     * @param string $code
     * @param string $password
     * @return bool
     */
    public function completeResetPassword(User $user, $code, $password);

    /**
     * Determines if the current user has access to the given permissions.
     *
     * @param array|string $permissions
     * @return bool
     */
    public function hasAccess($permissions);

    /**
     * Determine if the user has access to the any given permissions
     *
     * @param array|string $permissions
     * @return bool
     */
    public function hasAnyAccess($permissions);

    /**
     * Check if the user is logged in.
     *
     * @return bool
     */
    public function check();

    /**
     * Get the currently logged in user.
     *
     * @return \Modules\User\Entities\User
     */
    public function user();

    /**
     * Get the ID for the currently authenticated user.
     *
     * @return int|null
     */
    public function id();
}
