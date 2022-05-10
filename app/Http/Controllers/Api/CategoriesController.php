<?php

namespace App\Http\Controllers\Api;

use App\Filters\CategoryFilter;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoriesController extends Controller
{
    public function index (CategoryFilter $filter): JsonResource {
        return CategoryResource::collection(
            $this->paginate(Category::filter($filter)->withChildren()->position())
        );
    }
}
