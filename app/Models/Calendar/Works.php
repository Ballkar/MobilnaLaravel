<?php

namespace App\Models\Calendar;

use Illuminate\Database\Eloquent\Model;
use App\Models\Announcement\Customer;
use App\Models\User\User;

class Works extends Model
{
    protected $guarded = [];
    protected $table = 'calendar_works';

    public function owner()
    {
        return $this->hasOne(User::class, 'id', 'owner_id');
    }

    public function customer()
    {
        return $this->hasOne(Customer::class, 'id', 'customer_id');
    }
}
