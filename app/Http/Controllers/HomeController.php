<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Newsletter;
use App\Models\Product;
use Illuminate\Contracts\Support\Renderable;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index()
    {
        $categories = Category::count();

        $lastProducts = Product::orderDesc()->paginate(10);
        $productsActives = Product::active()->count();
        $products = Product::count();

        $lastNewsletters = Newsletter::orderDesc()->paginate(20);
        $newsletter = Newsletter::count();
        $newsletterActives = Newsletter::active()->count();

        return view('dashboard', compact(
            'categories',
            'products',
            'productsActives',
            'lastProducts',
            'newsletter',
            'newsletterActives',
            'lastNewsletters',
        ));
    }
}
