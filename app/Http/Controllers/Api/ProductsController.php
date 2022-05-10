<?php

namespace App\Http\Controllers\Api;

use App\Filters\ProductFilter;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductsController extends Controller
{
    public function index (ProductFilter $filter): JsonResource {
        return ProductResource::collection(
            $this->paginate(Product::filter($filter)->active()->featured())
        );
    }

    public function show (string $categorySlug, string $slug) {
        try {
            $product = Product::with('categories')
                ->whereHas('categories', function ($query) use ($categorySlug) {
                    $query->where('categories.slug', $categorySlug);
                })->active()->where('slug', $slug)->first();

            if ($product) return ProductResource::make($product);

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
