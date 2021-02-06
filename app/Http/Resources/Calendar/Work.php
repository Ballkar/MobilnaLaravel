<?php

namespace App\Http\Resources\Calendar;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Work extends JsonResource
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
            'start' => $this->start,
            'stop' => $this->stop,
            'customer' => [
                'id' => $customer->id,
                'phone' => $customer->phone,
                'name' => $customer->name,
                'surname' => $customer->surname,
            ],
            $this->mergeWhen($this->label, ['label' => new LabelResource($this->label)]),
            $this->mergeWhen(!$this->label, ['label' => null]),
        ];
    }
}
