<?php

namespace App\Filters;

class SliderFilter extends BaseFilter
{
    public function search($search)
    {
        $this->builder
            ->where('title', 'like', "%{$search}%");
    }
}
