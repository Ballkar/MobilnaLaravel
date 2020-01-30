<?php

namespace App\Http\Resources\Blog;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Post extends JsonResource
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
            'title' => $this->title,
            'text' => $this->text,
            'image' => $this->image,
            'category_name' => $this->category->name,
            'owner_id' => $this->owner->id,
            'active' => $this->active,
            'created_at' => $this->created_at,
        ];
    }
}
