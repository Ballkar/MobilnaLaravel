<?php

namespace App\Models\Message\Plans;

use App\Models\User\User;
use Illuminate\Database\Eloquent\Model;

class RemindPlan extends Model
{
    protected $table = 'plans_remind';
    public $timestamps = false;
    protected $guarded = [];
    protected $casts = [
        'body' => 'json',
    ];

    public function owner()
    {
        return $this->hasOne(User::class, 'id', 'owner_id');
    }
}
