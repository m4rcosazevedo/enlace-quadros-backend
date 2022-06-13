<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FileResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            "filename" => 'files/' . $this->filename,
            "url" => [
                "filename" => 'files/' . $this->filename,
                "origin" => env('AWS_URL_CLOUDFRONT'),
                "thumbnail" => $this->urlThumbnail,
                "large" => $this->urlLarge,
            ],
            "description" => $this->description
        ];
    }
}
