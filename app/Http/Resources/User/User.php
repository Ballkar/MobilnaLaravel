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
            'created_at' => $this->created_at,
            'email_verified' => $this->email_verified_at ? true : false,
            'unread_notifications' => $notifications->where('is_read', 0)->count(),
            'tutorials' => $this->tutorials,
            'wallet' => [
                'money' => $wallet->money / 100
            ],

            $this->mergeWhen(!$this->isAdmin(), function () use ($wallet) {
                return [
                ];
            }),

            $this->mergeWhen($this->isAdmin(), function () {
                return [
                ];
            }),
        ];
    }
}
