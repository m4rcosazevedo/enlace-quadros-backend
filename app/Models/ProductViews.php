<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Util\Filterable\Filterable;

class ProductViews extends Model
{
    use HasFactory, Filterable;

    protected $fillable = ['product_id', 'views'];

//    public function product()
//    {
//        return $this->belongsTo(Product::class, 'product_id', 'id');
//    }

    public function incrementView ()
    {
        $ip = request()->ip();

        if (!Cache::has($ip)) {
            $this->views = $this->views + 1;
            $this->save();
            Cache::put($ip, 1, 30);
        }
    }

}
