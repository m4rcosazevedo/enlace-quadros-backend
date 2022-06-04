<?php

namespace App\Filters;

class FileFilter extends BaseFilter
{
    public function search($search)
    {
        $this->builder
            ->where('filename', 'like', "%{$search}%")
            ->orWhere('description', 'like', "%{$search}%");
    }
}
