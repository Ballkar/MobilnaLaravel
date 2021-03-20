<?php

namespace App\Http\Resources\Message\Plans;

use App\Http\Resources\BaseResourceCollection;
use Illuminate\Http\Request;

class RemindPlanSchemaCollection extends BaseResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
