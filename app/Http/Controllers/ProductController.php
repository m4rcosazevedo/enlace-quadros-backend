<?php

namespace App\Http\Controllers;

use App\Filters\ProductFilter;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\File;
use App\Models\Product;
use App\Services\StorageService;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    protected StorageService $storage_service;
    protected Product $product;
    protected File $file;
    protected string $file_path;

    public function __construct (Product $product, StorageService $storage_service, File $file) {
        $this->storage_service = $storage_service;
        $this->product = $product;
        $this->file = $file;
        $this->file_path = "files/";
    }

    public function index (ProductFilter $filter) {
        $products = ProductResource::collection(
            $this->paginate($this->product->filter($filter)->orderDesc())
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

                $image = $this->file->create([
                    "filename" => $this->storage_service->save($this->file_path, $request->image),
                    "description" => $request->name,
                ]);

                $data['image_id'] = $image->id;
            }

            $product = $this->product->create($data);
            $this->saveCategories($request, $product);

            flash('Produto criado com sucesso.')->success();
        } catch (\Exception $e) {
            flash('Ocorreu um erro ao salvar o produto.')->error();
        }

        return redirect('/admin/product');
    }

    public function edit(int $id)
    {
        $product = $this->product->findOrFail($id);
        $categories = $this->categories();

        return view('products.form',  compact('product', 'categories'));
    }

    public function update(ProductUpdateRequest $request, int $id)
    {
        $data = $request->only("name", "description", "featured", "active");

        try {
            $product = $this->product->findOrFail($id);

            if ($request->hasFile('image') and $request->image->isValid()) {
                if ($product->image) {
                    $this->storage_service->delete($this->file_path, $product->image->filename);
                }

                $image = $this->file->create([
                    "filename" => $this->storage_service->save($this->file_path, $request->image),
                    "description" => $request->name,
                ]);

                $data['image_id'] = $image->id;
            }

            $product->update([
                "name" => $data["name"],
                "description" => $data["description"] ?? null,
                "featured" => $data["featured"] ?? false,
                "active" => $data["active"] ?? false,
                "image_id" => $data['image_id'] ?? $product->image->id
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
            $product = $this->product->findOrFail($id);

            if ($product->image) {
                //$file = $this->file->findOrFail($product->image->id);
                $this->storage_service->delete($this->file_path, $product->image->filename);
                //$file->delete();
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
