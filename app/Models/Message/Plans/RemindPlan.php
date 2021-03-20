<?php

namespace App\Models\Message\Plans;

use App\Models\User\User;
use Illuminate\Database\Eloquent\Model;

class RemindPlan extends Model
{
    protected $table = 'message_plans_remind';
    public $timestamps = false;
    protected $guarded = [];

    public function owner()
    {
        return $this->hasOne(User::class, 'id', 'owner_id');
    }

    public function schema()
    {
        return $this->hasOne(RemindPlanSchema::class, 'id', 'schema_id');
    }
}
