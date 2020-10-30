<?php

namespace App\Models\Message;

use Illuminate\Database\Eloquent\Model;

class MessageSchema extends Model
{
    protected $table = 'message_schemas';
    protected $guarded = [];

    public function messages()
    {
        return $this->hasMany(Message::class, 'schema_id', 'id');
    }
}
