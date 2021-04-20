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
            'role_id' => $this->role_id,
            'phone' => $this->phone,
            'email' => $this->email,
            'unread_notifications' => $notifications->where('is_read', 0)->count(),

            $this->mergeWhen(!$this->isAdmin(), function () use ($wallet) {
                return [
                    'tutorials' => $this->tutorials,
                    'wallet' => [
                        'money' => $wallet->money / 100
                    ],
                ];
            }),

            $this->mergeWhen($this->isAdmin(), function () {
                return [
                ];
            }),
        ];
    }
}
