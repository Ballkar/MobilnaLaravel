<?php

namespace App\Models\Calendar;

use App\Models\Worker;
use Illuminate\Database\Eloquent\Model;
use App\Models\Announcement\Customer;
use App\Models\User\User;

class Work extends Model
{
    protected $guarded = [];
    protected $table = 'calendar_works';

    public function owner()
    {
        return $this->hasOne(User::class, 'id', 'owner_id');
    }

    public function customer()
    {
        return $this->hasOne(Customer::class, 'id', 'customer_id')->withTrashed();
    }

    public function worker()
    {
        return $this->hasOne(Worker::class, 'id', 'worker_id');
    }
}
