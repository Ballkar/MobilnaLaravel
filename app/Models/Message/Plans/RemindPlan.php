<?php

namespace App\Models\Message\Plans;

use App\Models\User\User;
use Illuminate\Database\Eloquent\Model;

class RemindPlan extends Model
{
    public static $defaultBody = [
        ["text" => "Witaj "],
        [
            "variable" => [
                "model" => "customer",
                "name"=> "name",
            ],
        ],
        ["text" => ", pamiętaj o wizycie w naszym salonie jutro o godzinie: "],
        [
            "variable" => [
                "model" => "work",
                "name"=> "start_hour",
            ],
        ],
    ];
    public static $time_type_same_day = 1;
    public static $time_type_day_before = 2;
    protected $table = 'message_plans_remind';
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
