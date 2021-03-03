<?php

namespace App\Http\Controllers\Api\v1\Message;

use App\Http\Controllers\ApiCommunication;
use App\Http\Requests\Message\MessageSettingRequest;
use App\Http\Resources\Message\MessageSetting as MessageSettingResource;
use App\Http\Resources\Message\MessageSettingCollection;
use App\Models\Message\Plan;
use Exception;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlansController extends Controller
{
    use ApiCommunication;
    public static $time_type_same_day = 1;
    public static $time_type_day_before = 2;

    public function __construct()
    {
        $this->authorizeResource(Plan::class, 'plan');
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request)
    {
        $limit = $request->limit ? $request->limit : 10;
        $schemas = Plan::where('owner_id', Auth::id())->paginate($limit);
        return $this->sendResponse(new MessageSettingCollection($schemas), 'All message plan returned');
    }

    /**
     * @param Plan $plan
     * @return JsonResponse
     */
    public function show(Plan $plan)
    {
        return $this->sendResponse(new MessageSettingResource($plan), 'Message plan returned');
    }

    /**
     * @param MessageSettingRequest $request
     * @param Plan $plan
     * @return JsonResponse
     */
    public function update(MessageSettingRequest $request, Plan $plan)
    {
        $plan->update($request->validated());
        return $this->sendResponse(new MessageSettingResource($plan), 'Message plan updated');
    }

    /**
     * @param MessageSettingRequest $request
     * @return JsonResponse
     */
    public function store(MessageSettingRequest $request)
    {
        $messageSchema = Plan::create(array_merge($request->validated(), [
            'owner_id' => Auth::id(),
        ]));
        return $this->sendResponse(new MessageSettingResource($messageSchema), 'Message plan Added', 201);
    }

    /**
     * @param Plan $plan
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy(Plan $plan)
    {
        $plan->delete();
        return $this->sendResponse(null, 'Plan deleted', 204);
    }
}
