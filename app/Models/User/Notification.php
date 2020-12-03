<?php


namespace App\Models\User;


use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $guarded = [];
    protected $table = 'user_notifications';

    protected static function boot()
    {
        parent::boot();

        static::created(function () {
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function setAsRead()
    {
        $this->is_read = true;
        $this->update();
    }
}
