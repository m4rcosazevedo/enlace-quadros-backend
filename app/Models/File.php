<?php

namespace App\Models;

use App\Services\StorageService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Util\Filterable\Filterable;

class File extends Model
{
    use HasFactory, Filterable;

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

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
