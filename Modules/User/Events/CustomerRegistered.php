<?php

namespace Modules\User\Events;

use Modules\User\Entities\User;
use Illuminate\Queue\SerializesModels;

class CustomerRegistered
{
    use SerializesModels;

    /**
     * The instance of user.
     *
     * @var \Modules\User\Entities\User
     */
    public $user;

    /**
     * Create a new event instance.
     *
     * @param \Modules\User\Entities\User $user
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }
}
