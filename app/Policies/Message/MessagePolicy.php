<?php

namespace App\Policies\Message;

use App\Models\Message\Message;
use App\Models\User\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MessagePolicy
{
    use HandlesAuthorization;


    /**
     * Determine whether the user can view the message.
     *
     * @param User $user
     * @param Message $message
     * @return mixed
     */
    public function view(User $user, Message $message)
    {
        return $user->id === $message->owner_id;
    }

    /**
     * Determine whether the user can create messages.
     *
     * @param User $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true; // TODO: add check user account. if have enough money to send sms?
    }

}
