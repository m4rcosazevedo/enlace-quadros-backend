<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Util\Filterable\Filterable;

class Product extends Model
{
    use HasFactory, Filterable;

    protected $fillable = ["name", "featured", "active", "description", "image"];

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function scopeOrderDesc ($query) {
        return $query->orderBy('id', 'desc');
    }

    public function categories ()
    {
        return $this->belongsToMany(Category::class);
    }

    public function view()
    {
        return $this->belongsTo(ProductViews::class, 'id', 'product_id');
    }

    public function incrementView() {
        if ($this->view) {
            $this->view->incrementView();
            return $this->view->views;
        }

        $this->view()->create([
            'product_id' => $this->id,
            'views' => 1,
        ]);

        return 1;
    }

    public function scopeActive ($query)
    {
        return $query->where('active', true);
    }

    public function scopeFeatured ($query)
    {
        return $query
            ->orderBy('featured', 'desc')
            ->orderBy('updated_at', 'asc')
            ->orderBy('id', 'desc');
    }
}
