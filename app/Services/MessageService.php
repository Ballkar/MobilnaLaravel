<?php


namespace App\Services;


use App\Models\Announcement\Customer;
use App\Models\Calendar\Work;
use App\Models\User\User;
use Carbon\Carbon;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
use Instasent\SMSCounter\SMSCounter;

class MessageService
{
    public static $messageCost = 11;
    public $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://justsend.pl/api/rest/v2/',
            'headers' => [
                'content-type' => 'application/json',
                'App-Key' => env('MESSAGE_KEY')
            ]
        ]);
    }

    public function send($message, $from, $to, $doubleEncode = false, $type='PRO')
    {
        $url = 'message/send';
        $body = [
            'message' => $message,
            'to' => $to,
            'bulkVariant' => $type,
            "doubleEncode" => $doubleEncode,
            'from' => $from
        ];

        if(env('MESSAGE_SENDING_ENABLED')) {
            try {
                return $this->client->request('POST', $url, ['body' => json_encode($body)]);
            } catch (Exception $exception) {
                Log::channel('sendMessagePlans')->error($exception->getMessage());
            }
        } else {
            return null;
        }
    }

    public function checkMessageCountAvailable()
    {
        $url = 'payment/points';

        $response = $this->client->request('GET', $url);
        $body = json_decode($response->getBody()->getContents());
        $points = $body->data;
        return (int)floor($points / MessageService::$messageCost);
    }

    public static function checkUserIsAbleToSendSMS(User $user, string $messageText)
    {
        $smsCounter = new SMSCounter();
        $userMoney = $user->wallet->money;
        $cost = MessageService::$messageCost;
        $sms_count = $smsCounter->count($messageText)->messages;
        $sms_cost = $sms_count * $cost;
        if($userMoney < $sms_cost) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * @param $body
     * @param bool $clearDiacritics
     * @param Customer $customer
     * @param User $owner
     * @param Work|null $work
     * @return string
     * @throws Exception
     */
    public static function createTextFromSchema($body, bool $clearDiacritics , Customer $customer, User $owner, Work $work = null) : string
    {
        $res = '';
        $startDate = Carbon::now()->hour(14)->minute(30)->second(0);
        $endDate = Carbon::now()->hour(14)->minute(30)->second(0);
        $work = isset($work) ? $work : Work::make([
            'owner_id' => $owner->id,
            'customer_id' => $customer->id,
            'start' => $startDate->addHours(2),
            'stop' => $endDate->addHours(4),
        ]);

        foreach ($body as $element) {
            if(isset($element['text'])) {
                $res = $res.$element['text'];
            }

            if(isset($element['variable']) && isset($element['model'])) {
                try {
                    $res = $res.MessageService::returnValueModel($element['variable'], $element['model'], $customer, $owner, $work);
                } catch (Exception $exception) {
                    Log::channel('single')->error('Not known variable' . $element['variable'] . ' or model ' . $element['model'] . 'in Message Service');
                    throw new Exception($exception);
                }
            }
        }
        $smsCounter = new SMSCounter();
        return $clearDiacritics ? $smsCounter->sanitizeToGSM($res) : $res;
    }

    /**
     * @param string $variable
     * @param string $model
     * @param Customer $customer
     * @param User $owner
     * @param Work|null $work
     * @return string
     * @throws Exception
     */
    private static function returnValueModel(string $variable, string $model, Customer $customer, User $owner, Work $work) {


        switch ($model) {
            case 'customer':
                return MessageService::mapValueCustomerModel($variable, $customer);
            case 'work':
                return MessageService::mapValueWorkModel($variable, $work);
            case 'user':
                return MessageService::mapValueOwnerModel($variable, $owner);
            default:
                throw new Exception('Uknown Model');
        }

    }

    private static function mapValueCustomerModel(string $variable, Customer $customer) {
        switch ($variable) {
            case 'name':
                return $customer['name'];
            case 'surname':
                return $customer['surname'];
            default:
                throw new Exception('Uknown variable: '.$variable.' in Customer Model');
        }

    }

    private static function mapValueWorkModel(string $variable, Work $work) {
        $date = Carbon::createFromFormat('Y-m-d H:i:s', $work->start, 'Europe/Warsaw');
        switch ($variable) {
            case 'start_date':
                return $date->format('d-m-Y');
            case 'start_hour':
                return $date->format('H:i');
            default:
                throw new Exception('Uknown variable: '.$variable.' in Work Model');
        }
    }

    private static function mapValueOwnerModel(string $variable, User $user) {
        switch ($variable) {
            case 'name':
                return $user['name'];
            default:
                throw new Exception('Uknown variable: '.$variable.' in User Model');
        }
    }

}
