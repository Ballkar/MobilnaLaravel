<?php

namespace App\Events\User;

use App\Mail\Registered;
use App\Models\User\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Mail;

class UserWasRegistered extends Event
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;
    /**
     * UserWasRegistered constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;

        Mail::to($user->email)
            ->send(new Registered($user));
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
