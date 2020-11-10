<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class User extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $messageSettings = $this->messageSetting;
        return [
            'id' => $this->id,
            'name' => $this->name,
            'phone' => $this->phone,
            'email' => $this->email,
            'messageSettings' => [
                'hour' => $messageSettings->hour,
                'minute' => $messageSettings->minute,
                'dayBefore' => $messageSettings->day_before,
                'sameDay' => $messageSettings->same_day,
                'active' => $messageSettings->messages_active,
            ],
        ];
    }
}
