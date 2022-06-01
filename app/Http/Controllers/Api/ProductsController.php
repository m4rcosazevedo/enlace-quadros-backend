<?php

namespace App\Http\Controllers\Api;

use App\Events\ProductShowEvent;
use App\Filters\ProductFilter;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryParentResource;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Cache;

class ProductsController extends Controller
{
    public function index (ProductFilter $filter): JsonResource {
            $params = request()->query();
            $categorySlug = $params['category'] ?? null;

            $category = Category::where('slug', $categorySlug)->first();

            $category = (!empty($categorySlug) && !empty($category))
                ? CategoryParentResource::make($category)
                : null;

        return ProductResource::collection(
            $this->paginate(Product::filter($filter)->active()->featured())
        )->additional(['category' => $category]);
    }

    public function show (string $categorySlug, string $slug) {
        try {
            $product = Product::with('categories')
                ->whereHas('categories', function ($query) use ($categorySlug) {
                    $query->where('categories.slug', $categorySlug);
                })->active()->where('slug', $slug)->first();

            if ($product) {
                event(new ProductShowEvent($product));
                return ProductResource::make($product);
            }

            return response()->json([
                'code' => 404,
                'message' => 'Página não encontrada',
            ])->setStatusCode(404);
        } catch (\Exception $e) {
            return response()->json([
                'code' => $e->getCode(),
                'message' => $e->getMessage(),
            ])->setStatusCode($e->getCode());
        }
    }
}
