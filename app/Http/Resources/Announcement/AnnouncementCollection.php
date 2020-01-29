<?php

namespace App\Http\Resources\Announcement;

use App\Http\Resources\BaseResourceCollection;
use Illuminate\Http\Request;

class AnnouncementCollection extends BaseResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'items' => $this->collection,
            'pagination' => $this->pagination,
        ];
    }
}
