<?php

namespace App\Http\Controllers;

use App\Filters\ProductFilter;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index (ProductFilter $filter) {
        $products = ProductResource::collection(
            $this->paginate(Product::filter($filter)->orderDesc())
        );

        return view('products.index', compact('products'));
    }

    public function create () {
        $categories = $this->categories();
        return view('products.form', compact('categories'));
    }

    public function store (ProductRequest $request) {

        $data = $request->only('featured', 'active', 'name', 'description');

        try {

            if ($request->hasFile('image') and $request->image->isValid()) {
                $imagePath = $request->image->store('products');
                $data['image'] = $imagePath;
            }

            $product = Product::create($data);
            $this->saveCategories($request, $product);

            flash('Produto criado com sucesso.')->success();
        } catch (\Exception $e) {
            flash('Ocorreu um erro ao salvar o produto.')->error();
        }

        return redirect('/admin/product');
    }

    public function edit(int $id)
    {
        $product = Product::findOrFail($id);
        $categories = $this->categories();

        return view('products.form',  compact('product', 'categories'));
    }

    public function update(ProductUpdateRequest $request, int $id)
    {
        $data = $request->only("name", "description", "featured", "active");

        try {
            $product = Product::findOrFail($id);

            if ($request->hasFile('image') and $request->image->isValid()) {
                if ($product->image and Storage::exists($product->image)) {
                    Storage::delete($product->image);
                }

                $imagePath = $request->image->store('products');
                $data['image'] = $imagePath;
            }

            $product->update([
                "name" => $data["name"],
                "description" => $data["description"] ?? null,
                "featured" => $data["featured"] ?? false,
                "active" => $data["active"] ?? false,
                "image" => $data['image'] ?? $product->image
            ]);
            $this->saveCategories($request, $product);

            flash('Produto atualizado com sucesso.')->success();
            return redirect()->route('product.edit', $product->id);
        } catch (\Exception $e) {
            flash('Ocorreu um erro ao atualizar o produto.')->error();
            return redirect('/admin/product');
        }
    }

    public function destroy (int $id) {
        try {
            $product = Product::findOrFail($id);

            if ($product->image and Storage::exists($product->image)) {
                Storage::delete($product->image);
            }

            $product->delete();
            flash('Produto excluído com sucesso.')->success();
        } catch (\Exception $e) {
            flash('Ocorreu um erro ao excluir o produto.')->error();
        }
        return redirect()->route('product.index');
    }

    protected function categories ()
    {
        return Category::where('category_id', '<>', null)->get()->pluck('category_with_parent', 'id');
    }

    protected function saveCategories ($request, $product) {
        $product->categories()->sync($request->categories);
    }
}
