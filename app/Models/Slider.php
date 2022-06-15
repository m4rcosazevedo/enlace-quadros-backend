<?php

namespace App\Models;

use App\Services\DateService;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Util\Filterable\Filterable;

class Slider extends Model
{
    use HasFactory, Filterable;

    const ACTIVE = 1;
    const INACTIVE = 0;

    private string $CLOUDFRONT_URL;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->CLOUDFRONT_URL = env('AWS_URL_CLOUDFRONT', 'unknown');
    }

    protected $fillable = ["title", "url", "description", "image", "active", "start_at", "end_at"];

    public function getUrlLargeAttribute()
    {
        return $this->CLOUDFRONT_URL . '/fit-in/0x764/filters:quality(70)/files/' . $this->image;
    }

    public function getUrlThumbnailAttribute()
    {
        return $this->CLOUDFRONT_URL . '/fit-in/0x100/filters:quality(70)/files/' . $this->image;
    }

    public function scopeOrderDesc ($query)
    {
        return $query->orderBy('id', 'desc');
    }

    public function scopeActive ($query)
    {
        $now = Carbon::now(-3)->startOfMinute();

        return $query
            ->where('active', self::ACTIVE)
            ->where(function ($query) use ($now) {
                $query
                    ->where('start_at', "<=", $now)
                    ->orWhereNull('start_at');
            })
            ->where(function ($query) use ($now) {
                $query
                    ->where('end_at', ">=", $now)
                    ->orWhereNull('end_at');
            });
    }

    public function getStartAtTextAttribute()
    {
        return $this->toDateString($this->start_at);
    }

    public function getEndAtTextAttribute()
    {
        return $this->toDateString($this->end_at);
    }

    public function getStartAtAttribute($value)
    {
        return $this->toDateHtmlInput($value);
    }

    public function getEndAtAttribute($value)
    {
        return $this->toDateHtmlInput($value);
    }

    private function toDateHtmlInput ($date)
    {
        return DateService::format($date, 'Y-m-d\TH:i');
    }

    private function toDateString ($date)
    {
        return DateService::format($date, 'd/m/Y H:i');
    }
}
