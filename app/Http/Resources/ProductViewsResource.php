<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductViewsResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'views' => $this->views,
//            'createdAt' => $this->created_at,
//            'updatedAt' => $this->updated_at,
        ];
    }
}
