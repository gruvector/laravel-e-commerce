<?php

namespace Modules\User\Events;

use Modules\User\Entities\User;
use Illuminate\Queue\SerializesModels;

class UserHasRegistered
{
    use SerializesModels;

    /**
     * The user instance.
     *
     * @var \Modules\User\Entities\User
     */
    public $user;

    /**
     * Create a new event instance.
     *
     * @param \Modules\User\Entities\User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }
}
