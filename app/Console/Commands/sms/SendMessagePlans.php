<?php

namespace App\Console\Commands\sms;

use App\Exceptions\UserNoMoneySmsException;
use App\Http\Controllers\Api\v1\Message\PlansController;
use App\Models\Announcement\Customer;
use App\Models\Calendar\Work;
use App\Models\Message\Message;
use App\Models\Message\Plan;
use App\Models\User\User;
use App\Services\MessageService;
use Carbon\Carbon;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Instasent\SMSCounter\SMSCounter;

class SendMessagePlans extends Command
{
    protected $signature = 'sendMessagePlans';
    protected $description = 'Sending sms messages from active plans';
    private $messageService;
    private $smsCounter;
    private $smsCost;


    public function __construct()
    {
        parent::__construct();
        $this->messageService = new MessageService();
        $this->smsCounter = new SMSCounter();
        $this->smsCost = MessageService::$messageCost;
    }

    /**
     * Execute the console command.
     *
     */
    public function handle()
    {
        $date = Carbon::now();
        $plans = Plan::where('active', true)
            ->where('hour', $date->hour)
            ->where('minute', $date->minute)
            ->get();

        if(!isset($plans[0])) {
            Log::channel('sendMessagePlans')->error('No active plans');
            return false;
        }

        foreach ($plans as $plan) {
            $works = $this->getWorksForPlan($plan, $date);
            if(!isset($works[0])) {
                continue;
            }

            try {
                $this->sendMessagesForWorks($plan, $works);
            } catch (Exception $e) {
                Log::channel('sendMessagePlans')->error($e->getMessage());
            }

        }

    }

    public function getWorksForPlan(Plan $plan, Carbon $nowDate)
    {
        $nowDate = $plan->time_type == PlansController::$time_type_same_day ? $nowDate : $nowDate->addDay();
        $works = Work::where('owner_id', $plan->owner_id)
            ->whereDate('start', $nowDate->toDateString())
            ->get();

        return $works;
    }

    public function sendMessagesForWorks(Plan $plan, $works)
    {
        $schema = $plan->schema;
        $owner = User::find($plan->owner->id);
        $userWallet = $owner->wallet;
        $userMoney = $userWallet->money;

        foreach ($works as $work) {
            $customer = Customer::find($work->customer_id);

            $text = MessageService::createTextFromSchema($schema->body, $schema->clear_diacritics, $customer, $owner, $work);
//            try {
//            } catch (Exception $e) {
//                Log::channel('single')->info('Nie było planów');
//            }

            $sms_count = $this->smsCounter->count($text)->messages;
            $sms_cost = $sms_count * $this->smsCost;
            if($userMoney < $sms_cost) {
                Log::channel('sendMessagePlans')->alert('Not enough money wallet id: ' . $userWallet->id . ' user owner id: ' . $owner->id);
                return false;  // TODO: add notification
            }

            try {
//                $this->messageService->send($text, $owner->name, $customer->phone);
                $userWallet->subtract($sms_cost);
                Message::create([
                    'owner_id' => $owner->id,
                    'customer_id' => $customer->id,
                    'name' => $schema->name,
                    'text' => $text,
                ]);
            } catch (Exception $e) {
                Log::channel('sendMessagePlans')->error('Error sending during sms! userID:' . $owner->id . ' message cost: '. $sms_cost);
                throw new Exception($e);
            }

        }


    }
}
