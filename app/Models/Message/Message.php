<?php

namespace App\Models\Message;

use Illuminate\Database\Eloquent\Model;
use App\Models\Announcement\Customer;

class Message extends Model
{
    protected $guarded = [];

    public function customer()
    {
        return $this->hasOne(Customer::class, 'id', 'customer_id');
    }
}
