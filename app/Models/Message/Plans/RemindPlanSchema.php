<?php

namespace App\Models\Message\Plans;

use Illuminate\Database\Eloquent\Model;

class RemindPlanSchema extends Model
{
    protected $table = 'message_plans_remind_schema';
    public $timestamps = false;
    protected $guarded = [];
    protected $casts = [
        'body' => 'json',
    ];
}
