<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "slug" => $this->slug,
            "parent" => CategoryParentResource::make($this->parent),
            "description" => $this->description,
            "position" => $this->position,
            "children" => CategoryParentResource::collection($this->children)
        ];
    }
}
