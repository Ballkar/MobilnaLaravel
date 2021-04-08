<?php

namespace App\Http\Resources\Calendar;

use App\Http\Resources\BaseResourceCollection;
use Illuminate\Http\Request;

class WorkerCollection extends BaseResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
