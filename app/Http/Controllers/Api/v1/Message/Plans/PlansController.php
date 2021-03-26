<?php

namespace App\Http\Controllers\Api\v1\Message\Plans;

use App\Http\Controllers\ApiCommunication;
use App\Http\Resources\Message\Plans\RemindPlan as RemindPlanResource;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PlansController extends Controller
{
    use ApiCommunication;

    /**
     * @return JsonResponse
     */
    public function index()
    {
        $user = Auth::user();
        $plan = $user->remindPlan;
        return $this->sendResponse(['remindPlan' => new RemindPlanResource($plan)], 'Plan returned');
    }
}
