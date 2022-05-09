<?php

namespace App\Providers;

use App\Models\Menu;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();

        Event::listen(BuildingMenu::class, function (BuildingMenu $event) {
            $items = app(Menu::class)::where('active', true)->get()->map(function (Menu $menu)  {
                return [
                    'key' => 'menu-' . $menu['id'],
                    'text' => $menu['title'],
                    'url' => 'admin/' . $menu['uri'],
//                    'active' => "admin/{$menu['uri']}/*",
                    'icon' => $menu['icon'],
                ];
            });
            //dd(...$items);

            $event->menu->addAfter('dashboard', ...$items);
        });
    }
}
