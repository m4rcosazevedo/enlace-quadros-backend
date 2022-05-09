<?php

namespace App\Filters;

use Util\Filterable\QueryFilter;

class BaseFilter extends QueryFilter
{
    /**
     * @param $field
     * @return void
     */
    public function sort ($fieldAndSort = 'id,asc')
    {
        $parts = explode(',', $fieldAndSort);
        $field = empty($parts[1]) ? 'id' : $parts[0];
        $sort = empty($parts[1]) ? $parts[0] : $parts[1];
        $this->builder->orderBy($field, $sort);
    }
}
