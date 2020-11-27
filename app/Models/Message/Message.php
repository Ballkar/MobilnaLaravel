<?php

namespace App\Models\Message;

use App\Models\User\User;
use App\Services\MessageService;
use Illuminate\Database\Eloquent\Model;
use App\Models\Announcement\Customer;

class Message extends Model
{
    protected $guarded = [];


    public static function boot()
    {
        static::created(function (Message $message) {
            $message->owner->wallet->subtract(MessageService::$messageCost);
        });

        parent::boot();
    }

    public function owner()
    {
        return $this->hasOne(User::class, 'id', 'owner_id');
    }

    public function customer()
    {
        return $this->hasOne(Customer::class, 'id', 'customer_id');
    }
}
