<?php

namespace App\Http\Resources\Announcement;

use App\Models\Announcement\Service\Service;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Announcement extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'description' => $this->description,
            'city' => $this->city->name,
            'owner_name' => $this->owner->name,
            'main_photo' => $this->main_image,
            'is_active' => $this->is_active,
            'is_local' => $this->is_local,
            'is_mobile' => $this->is_mobile,
            $this->mergeWhen($this->is_mobile, [
                'mobile_price' => $this->mobile_price,
                'mobile_distance' => $this->mobile_distance,
            ]),
            $this->mergeWhen($this->is_local, [
                'road' => $this->road,
                'house_number' => $this->house_number,
                'flat_number' => $this->flat_number,
            ]),
            'services' => $this->services,
        ];
    }
}
