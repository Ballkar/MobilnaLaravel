<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MessageSchema extends Model
{
    protected $guarded = [];

    public function messages()
    {
        return $this->hasMany(Message::class, 'schema_id', 'id');
    }
}
