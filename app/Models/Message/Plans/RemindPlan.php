<?php

namespace App\Models\Message\Plans;

use App\Models\User\User;
use Illuminate\Database\Eloquent\Model;

class RemindPlan extends Model
{
    public $timestamps = false;
    public static $sendHour = 17;
    public static $sendMinute = 00;
    protected $table = 'message_plans_remind';
    protected $guarded = [];

    public function owner()
    {
        return $this->hasOne(User::class, 'id', 'owner_id');
    }

    public function schema()
    {
        return $this->hasOne(PlanSchema::class, 'id', 'schema_id');
    }
}
