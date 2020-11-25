<?php


namespace App\Models\User;


use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    protected $guarded = [];

    public function owner()
    {
        return $this->hasOne(User::class, 'id', 'owner_id');
    }

    public function add(int $amount)
    {
        $this->money = $this->money + $amount;
        $this->update();
    }

    public function subtract(int $amount)
    {
        $this->money = $this->money - $amount;
        $this->update();
    }
}
