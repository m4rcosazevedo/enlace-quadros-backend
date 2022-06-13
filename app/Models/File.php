<?php

namespace App\Models;

use App\Services\StorageService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Util\Filterable\Filterable;

class File extends Model
{
    use HasFactory, Filterable;

    private string $CLOUDFRONT_URL;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->CLOUDFRONT_URL = env('AWS_URL_CLOUDFRONT', 'unknown');
    }

    protected $fillable = ["filename", "description"];

    public function scopeOrderDesc ($query)
    {
        return $query->orderBy('id', 'desc');
    }

    public function getUrlAttribute()
    {
        $storageService = new StorageService();
        return $storageService->get('files/', $this->filename);
    }

    public function getUrlLargeAttribute()
    {
        return $this->CLOUDFRONT_URL . '/fit-in/0x764/filters:quality(70)/files/' . $this->filename;
    }

    public function getUrlThumbnailAttribute()
    {
        return $this->CLOUDFRONT_URL . '/fit-in/0x100/filters:quality(70)/files/' . $this->filename;
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
