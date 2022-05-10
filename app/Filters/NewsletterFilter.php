<?php

namespace App\Filters;

class NewsletterFilter extends BaseFilter
{
    public function search($search)
    {
        $this->builder
            ->where('email', 'like', "%{$search}%")
            ->orWhere('name', 'like', "%{$search}%");
    }
}
