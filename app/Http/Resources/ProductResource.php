<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "slug" => $this->slug,
            "description" => $this->description,
            "image" => $this->image,
            "featured" => $this->featured,
            "active" => $this->active,
            "categories" => CategoryParentResource::collection($this->categories),
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at,
            "views" => ProductViewsResource::make($this->view),
        ];
    }
}
