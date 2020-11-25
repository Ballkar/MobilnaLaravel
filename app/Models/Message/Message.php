<?php

namespace App\Models\Message;

use Illuminate\Database\Eloquent\Model;
use App\Models\Announcement\Customer;
use Instasent\SMSCounter\SMSCounter;

class Message extends Model
{
    protected $guarded = [];

    public static function smsCount($text, $unicode)
    {

        $smsCounter = new SMSCounter();
        $smsCountObject = $smsCounter->count($text);
//        $smsCounter->countWithShiftTables('some-string-to-be-counted');

        $messagesCount = $smsCountObject->messages;
        if($messagesCount > 3) {
            throw new \Error('Brak środków na koncie');
            // TODO: wyrzuć błąd jeżeli chce wysłać więcej sms niż mam na koncie.
        }
        return $smsCountObject;
    }

    public function customer()
    {
        return $this->hasOne(Customer::class, 'id', 'customer_id');
    }
}
