<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Util\Filterable\Filterable;

class Category extends Model
{
    use HasFactory, Filterable;

    protected $fillable = ["name", "category_id", "description", "position"];

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function setCategoryIdAttribute($value)
    {
        return $this->setDefaultValue('category_id', $value, null);
    }

    public function setPositionAttribute($value)
    {
        return $this->setDefaultValue('position', $value, 0);
    }

    public function parent () {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function children () {
        return $this->hasMany(Category::class, 'category_id');
    }

    public function setDefaultValue (string $field, mixed $value, mixed $defaultValue)
    {
        return $this->attributes[$field] = empty($value) ? $defaultValue : $value;
    }

    public function scopeOrderDesc ($query) {
        return $query->orderBy('id', 'desc');
    }

    public function scopePosition ($query) {
        return $query->orderBy('position', 'asc');
    }

    public function scopeWithChildren ($query) {
        return $query->has('children');
    }

    public function getCategoryWithParentAttribute()
    {
        return "{$this->name} - ({$this->parent->name})";
    }
}
