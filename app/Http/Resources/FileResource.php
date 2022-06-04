<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FileResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            "filename" => $this->filename,
            "url" => $this->url,
            "description" => $this->description
        ];
    }
}
