<?php

namespace App\Console\Commands\sms;

use App\Http\Controllers\Api\v1\Message\Plans\RemindPlanController;
use App\Models\Announcement\Customer;
use App\Models\Calendar\Work;
use App\Models\Message\Message;
use App\Models\Message\Plans\RemindPlan;
use App\Models\User\User;
use App\Services\MessageService;
use App\Services\NotificationService;
use Carbon\Carbon;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Instasent\SMSCounter\SMSCounter;

class SendMessageRemindPlans extends Command
{
    protected $signature = 'SendMessageRemindPlans';
    protected $description = 'Sending sms reminding plans';
    private $messageService;
    private $smsCounter;
    private $smsCost;
    private $notificationService;


    public function __construct()
    {
        parent::__construct();
        $this->messageService = new MessageService();
        $this->smsCounter = new SMSCounter();
        $this->notificationService = new NotificationService();
        $this->smsCost = MessageService::$messageCost;
    }

    /**
     * Execute the console command.
     *
     */
    public function handle()
    {
        $plans = RemindPlan::where('active', true)->get();

        if(!isset($plans[0])) {
            Log::channel('sendMessagePlans')->info('No active plans');
            return false;
        }

        foreach ($plans as $plan) {
            $works = $this->getWorksForPlan($plan);
            if(!isset($works[0])) {
                continue;
            }

            try {
                $this->sendMessagesForWorks($plan, $works);
            } catch (Exception $e) {
                Log::channel('sendMessagePlans')->error($e->getMessage()); // TODO: rename channel
            }

        }
        return true;
    }

    public function getWorksForPlan(RemindPlan $plan)
    {
        $date = Carbon::now()->addDay();
        $works = Work::where('owner_id', $plan->owner_id)
            ->whereDate('start', $date->toDateString())
            ->get();

        return $works;
    }

    public function sendMessagesForWorks(RemindPlan $plan, $works)
    {
        $owner = User::find($plan->owner->id);
        $userWallet = $owner->wallet;

        foreach ($works as $work) {
            $customer = Customer::find($work->customer_id);
            $messageText = MessageService::createTextFromSchema($plan->body, $plan->clear_diacritics, $customer, $owner, $work);
            $sms_count = $this->smsCounter->count($messageText)->messages;
            $sms_cost = $sms_count * $this->smsCost;

            if (!MessageService::checkUserIsAbleToSendSMS($owner, $messageText)) {
                Log::channel('sendMessagePlans')->alert('Not enough money wallet id: ' . $userWallet->id . ' user owner id: ' . $owner->id);
                $this->notificationService->sendNotification($owner->id, 'Wiadomość nie została wysłana', 'Posiadasz zbyt mało środków na koncie', NotificationService::$NOTIFICATION_TYPE_ERROR);
                return false;
            }

            try {
                $this->messageService->send($messageText, $owner->name, $customer->phone);
                $userWallet->subtract($sms_cost);
                Message::create([
                    'owner_id' => $owner->id,
                    'customer_id' => $customer->id,
                    'name' => 'Przypomnienie',
                    'text' => $messageText,
                ]);
            } catch (Exception $e) {
                Log::channel('sendMessagePlans')->error('Error sending during sms! userID:' . $owner->id . ' message cost: ' . $sms_cost);
                $this->notificationService->sendNotificationToAdmin('Problem podczas wysyłki Planów: ' . Carbon::now()->toDateString(), '', NotificationService::$NOTIFICATION_TYPE_ERROR);
                throw new Exception($e);
            }

        }

        Log::channel('sendMessagePlans')->info('done');
    }
}
