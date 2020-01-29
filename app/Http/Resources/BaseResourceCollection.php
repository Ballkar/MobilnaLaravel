<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class BaseResourceCollection extends ResourceCollection
{
    protected $pagination;

    public function __construct($resource)
    {
        $this->pagination = [
            'current_page' => $resource->currentPage(),
            'last_page' => $resource->lastPage(),
            'total' => $resource->total(),
            'count' => $resource->count(),
            'per_page' => $resource->perPage(),
            'total_pages' => $resource->lastPage(),
        ];

        $resource = $resource->getCollection();

        parent::__construct($resource);
    }

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
