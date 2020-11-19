<?php

namespace App\Models\Message;

use App\Models\User\User;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $table = 'message_plans';
    protected $guarded = [];

    public function owner()
    {
        return $this->hasOne(User::class, 'id', 'owner_id');
    }

    public function schema()
    {
        return $this->hasOne(Schema::class, 'id', 'schema_id');
    }
}
