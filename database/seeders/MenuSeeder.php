<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (!Menu::get()->count()) {
            DB::table('menus')->insert([
                ['title' => 'Categorias', 'uri' => 'category', 'icon' => 'fas fa-tags', 'active' => true],
                ['title' => 'Produtos', 'uri' => 'product', 'icon' => 'fas fa-shopping-bag', 'active' => true],
                ['title' => 'Newsletter', 'uri' => 'newsletter', 'icon' => 'fas fa-mail-bulk', 'active' => true],
                ['title' => 'Files', 'uri' => 'file', 'icon' => 'fas fa-image', 'active' => true],
                ['title' => 'Sliders', 'uri' => 'slider', 'icon' => 'fas fa-images', 'active' => true],
            ]);
        }
    }
}
