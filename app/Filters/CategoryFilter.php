<?php

namespace App\Filters;

class CategoryFilter extends BaseFilter
{
    public function search($search)
    {
        $this->builder->where('name', 'like', "%{$search}%");
    }
}
