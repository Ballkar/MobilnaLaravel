<?php

namespace App\Models\Message\Plans;

use Illuminate\Database\Eloquent\Model;

class PlanSchema extends Model
{
    protected $table = 'message_plans_schemas';
    public $timestamps = false;
    protected $guarded = [];
    protected $casts = [
        'body' => 'json',
    ];
}
