<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SliderResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            "title" => $this->title,
            "url" => $this->url,
            "description" => $this->description,
            "image" => [
                "filename" => 'files/' . $this->image,
                "origin" => env('AWS_URL_CLOUDFRONT'),
            ],
            "active" => $this->active,
            "startAt" => $this->start_at,
            "endAt" => $this->end_at
        ];
    }
}
