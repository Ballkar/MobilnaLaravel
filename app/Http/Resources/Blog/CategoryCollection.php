<?php

namespace App\Http\Resources\Blog;

use App\Http\Resources\BaseResourceCollection;
use Illuminate\Http\Request;

class CategoryCollection extends BaseResourceCollection
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
