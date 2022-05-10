<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Util\Filterable\Filterable;

class Newsletter extends Model
{
    use HasFactory, Filterable;

    protected $fillable = ["name", "email", "active"];

    public function getCreatedAttribute()
    {
        return $this->created_at->diffForHumans();
        // return \Carbon\Carbon::parse($this->created_at)->format('d/m/Y H:i:s');
    }

    public function scopeOrderDesc ($query)
    {
        return $query->orderBy('id', 'desc');
    }

    public function scopeActive ($query)
    {
        return $query->where('active', '=', 1);
    }
}
