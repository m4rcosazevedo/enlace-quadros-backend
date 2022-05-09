<?php

namespace App\Filters;

class ProductFilter extends BaseFilter
{
    public function search($search)
    {
        //$this->builder->where('name', 'like', "%{$search}%");
        $this->builder->whereHas('categories', function ($query) use ($search) {
            return $query->where('name', 'like', "%{$search}%");
        })->orWhere('name', 'like', "%{$search}%");
    }
}
