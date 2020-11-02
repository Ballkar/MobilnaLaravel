<?php

namespace App\Http\Resources\Message;

use Illuminate\Http\Resources\Json\JsonResource;

class Message extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $customer = $this->customer;
        return [
            'id' => $this->id,
            'name' => $this->name,
            'text' => $this->text,
            'customer' => [
                'id' => $customer->id,
                'phone' => $customer->phone,
                'name' => $customer->name,
                'surname' => $customer->surname,
            ],
            'created_at' => $this->created_at,
        ];
    }
}
