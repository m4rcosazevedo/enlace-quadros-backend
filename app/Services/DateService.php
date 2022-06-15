<?php

namespace App\Services;

use Carbon\Carbon;

class DateService
{
    /**
     * @param $date string|\DateTimeInterface|null
     * @param $format
     * @return string|null
     */
    public static function format ($date, $format = 'Y-m-d H:i:s')
    {
        return $date
            ? Carbon::parse($date)->format($format)
            : null;
    }
}
