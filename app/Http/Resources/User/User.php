<?php

namespace App\Http\Resources\User;

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
        $wallet = $this->wallet;
        $notifications = $this->notifications();
        return [
            'id' => $this->id,
            'name' => $this->name,
            'phone' => $this->phone,
            'email' => $this->email,
            'tutorials' => $this->tutorials,
            'unread_notifications' => $notifications->where('is_read', 0)->count(),
            'wallet' => [
                'money' => $wallet->money / 100
            ],
        ];
    }
}
