<?php

namespace App\Http\Controllers\Api\v1\Message;

use App\Http\Controllers\ApiCommunication;
use App\Http\Requests\Message\MessageSettingRequest;
use App\Http\Resources\Message\MessageSetting as MessageSettingResource;
use App\Http\Resources\Message\MessageSettingCollection;
use App\Models\Message\MessageSetting;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MessageSettingsController extends Controller
{
    use ApiCommunication;

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request)
    {
        $limit = $request->limit ? $request->limit : 10;
        $schemas = MessageSetting::paginate($limit);
        return $this->sendResponse(new MessageSettingCollection($schemas), 'All message settings returned');
    }

    /**
     * @param MessageSetting $setting
     * @return JsonResponse
     */
    public function show(MessageSetting $setting)
    {
        return $this->sendResponse(new MessageSettingResource($setting), 'Message setting returned');
    }

    /**
     * @param MessageSettingRequest $request
     * @param MessageSetting $setting
     * @return JsonResponse
     */
    public function update(MessageSettingRequest $request, MessageSetting $setting)
    {
        $setting->update($request->validated());
        return $this->sendResponse(new MessageSettingResource($setting), 'Message setting updated');
    }
}
