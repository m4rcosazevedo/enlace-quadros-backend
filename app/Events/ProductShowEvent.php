<?php

namespace App\Events;

use App\Models\Product;
use Illuminate\Queue\SerializesModels;

class ProductShowEvent
{
    use SerializesModels;

    protected $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    /**
     * @return mixed
     */
    public function getProduct()
    {
        return $this->product;
    }
}
