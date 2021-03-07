<?php

namespace App\Http\Controllers\Api\v1\Message\Plans;

use App\Http\Controllers\ApiCommunication;
use App\Http\Requests\Message\Plans\RemindPlanPreviewRequest;
use App\Http\Requests\Message\Plans\RemindPlanRequest;
use App\Http\Resources\Message\Plans\RemindPlan as RemindPlanResource;
use App\Models\Announcement\Customer;
use App\Models\Message\Plans\RemindPlan;
use App\Models\User\User;
use App\Services\MessageService;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Instasent\SMSCounter\SMSCounter;

class RemindPlanController extends Controller
{
    use ApiCommunication;
    public static $time_type_same_day = 1;
    public static $time_type_day_before = 2;

    public function __construct()
    {
//        $this->authorizeResource(RemindPlan::class, 'plan');
    }

    /**
     * @return JsonResponse
     */
    public function show()
    {
        $user = Auth::user();
        $plan = $user->remindPlan;
        return $this->sendResponse(new RemindPlanResource($plan), 'Plan returned');
    }

    /**
     * @param RemindPlanRequest $request
     * @param RemindPlan $plan
     * @return JsonResponse
     */
    public function update(RemindPlanRequest $request, RemindPlan $plan)
    {
        $user = Auth::user();
        $plan = $user->remindPlan;
        $plan->update($request->validated());
        return $this->sendResponse(new RemindPlanResource($plan), 'Plan updated');
    }

    public function preview(RemindPlanPreviewRequest $request)
    {
        $customer = Customer::find($request->customer_id);
        $body = $request->body;
        $clearDiacritics = $request->clear_diacritics;
        $owner = User::find(Auth::id());
        try {
            $smsCounter = new SMSCounter();
            $previewRes = MessageService::createTextFromSchema($body, $clearDiacritics, $customer, $owner);
            $dataInfo = $smsCounter->count($previewRes);

            return $this->sendResponse([
                'from' => $owner->name,
                'preview' => $previewRes,
                'letter_count' => $dataInfo->length,
                'letter_next_limit' => $dataInfo->length + $dataInfo->remaining,
                'sms_count' => $dataInfo->messages,
            ], 'Preview returned', 200);
        } catch (Exception $e) {
            return $this->sendError($e->getMessage(), 422, 'Error during preview Generation');
        }
    }
}
