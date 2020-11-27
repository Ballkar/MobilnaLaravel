<?php

namespace App\Console\Commands\sms;

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
use Instasent\SMSCounter\SMSCounter;

class SendMessagePlans extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sendMessagePlans';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sending sms messages from active plans';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
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
            echo 'No plans active';
        }

        foreach ($plans as $plan) {
            $works = $this->getWorksForPlan($plan, $date);
            if(!isset($works[0])) {
                continue;
            }

            try {
                $this->sendMessagesForWorks($plan, $works);
            } catch (Exception $e) {
                echo $e->getMessage();
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
        $messageService = new MessageService();
        $smsCounter = new SMSCounter();
        $schema = $plan->schema;
        $body = $schema->body;
        $clearDiacritics = $schema->clear_diacritics;
        $owner = User::find($plan->owner->id);

        foreach ($works as $work) {
            $customer = Customer::find($work->customer_id);
            $userWallet = $owner->wallet;
            $userMoney = $userWallet->money;
            $cost = MessageService::$messageCost;
            try {
                $text = MessageService::createTextFromSchema($body, $clearDiacritics, $customer, $owner, $work);
            } catch (Exception $e) {
                echo $e->getMessage();
            }
            $dataInfo = $smsCounter->count($text);
            $sms_count = $dataInfo->messages;
            $sms_cost = $sms_count * $cost;
            if($userMoney < $sms_cost) {
                throw new Exception('not enough money in user account');
            }

            Message::create([
                'owner_id' => $owner->id,
                'customer_id' => $customer->id,
                'name' => $schema->name,
                'text' => $text,
            ]);
            $messageService->send($text, $owner->name, $customer->phone);
        }


    }
}
