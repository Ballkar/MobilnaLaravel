<?php


namespace App\Models\User;


use Illuminate\Database\Eloquent\Model;

class WalletTransaction extends Model
{
    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();

        static::created(function (WalletTransaction $transaction) {
            $wallet = $transaction->wallet;
            if ($transaction->type === 'ADD') {
                $wallet->add($transaction->money);
            }
            if ($transaction->type === 'SUBTRACT') {
                $wallet->subtract($transaction->money);
            }
        });
    }

    public function wallet()
    {
        return $this->belongsTo(Wallet::class);
    }
}
