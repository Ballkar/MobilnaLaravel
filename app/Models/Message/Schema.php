<?php

namespace App\Models\Message;

use Illuminate\Database\Eloquent\Model;

class Schema extends Model
{
    protected $table = 'message_schemas';
    protected $guarded = [];
    protected $casts = [
        'body' => 'json',
    ];

    public function messages()
    {
        return $this->hasMany(Message::class, 'schema_id', 'id');
    }

    public function plans()
    {
        return $this->hasMany(Plan::class, 'schema_id', 'id');
    }
}
