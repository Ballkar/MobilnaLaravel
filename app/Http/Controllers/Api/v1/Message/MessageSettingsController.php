<?php

namespace App\Http\Controllers\Api\v1\Message;

use App\Http\Controllers\ApiCommunication;
use App\Http\Requests\Message\MessageSettingRequest;
use App\Http\Resources\Message\MessageSetting as MessageSettingResource;
use App\Models\Message\MessageSetting;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

class MessageSettingsController extends Controller
{
    use ApiCommunication;


    /**
     * @param MessageSetting $setting
     * @return JsonResponse
     */
    public function show(MessageSetting $setting)
    {
        return $this->sendResponse(new MessageSettingResource($setting), 'MessageSetting returned');
    }

    /**
     * @param MessageSettingRequest $request
     * @param MessageSetting $setting
     * @return JsonResponse
     */
    public function update(MessageSettingRequest $request, MessageSetting $setting)
    {
        $MessageSetting->update($request->validated());
        return $this->sendResponse(new MessageSettingResource($setting), 'MessageSetting updated');
    }
}
