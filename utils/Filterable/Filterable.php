<?php

namespace Util\Filterable;

use Illuminate\Database\Eloquent\Builder;
use Util\Filterable\QueryFilter;

trait Filterable
{
    /**
     * @param $query
     * @param QueryFilter $filter
     * @return Builder
     */
    public function scopeFilter($query, QueryFilter $filter)
    {
        return $filter->apply($query);
    }
}
