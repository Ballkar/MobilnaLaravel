<?php

namespace App\Models\Message;

use App\Models\User\User;
use Illuminate\Database\Eloquent\Model;

class MessageSetting extends Model
{
    protected $guarded = [];

    public function owner()
    {
        return $this->hasOne(User::class, 'id', 'owner_id');
    }

    public function schema()
    {
        return $this->hasOne(MessageSchema::class, 'id', 'schema_id');
    }
}
