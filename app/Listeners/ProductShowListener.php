<?php

namespace App\Listeners;

use App\Events\ProductShowEvent;
use Illuminate\Contracts\Queue\ShouldQueue;

class ProductShowListener implements ShouldQueue
{

    public function __construct()
    {
    }

    public function handle(ProductShowEvent $event)
    {
        $event->getSteamItem()->incrementView();
    }
}
