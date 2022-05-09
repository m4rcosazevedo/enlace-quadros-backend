<?php

namespace App\Http\Controllers;

use App\Filters\CategoryFilter;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index (CategoryFilter $filter)
    {
        $categories = CategoryResource::collection(
            $this->paginate(Category::filter($filter)->orderDesc())
        );
        return view('categories.index', compact('categories'));
    }

    public function create ()
    {
        $categories = $this->categories();
        return view('categories.form',  compact('categories'));
    }

    public function store(CategoryRequest $request)
    {
        try {
            Category::create($request->all());
            flash('Categoria criada com sucesso.')->success();
        } catch (\Exception $e) {
            flash('Ocorreu um erro ao salvar a categoria.')->error();
        }

        return redirect('/admin/category');
    }

    public function edit(int $id)
    {
        $category = Category::findOrFail($id);
        $categories = $this->categories();

        return view('categories.form',  compact('category', 'categories'));
    }

    public function update(CategoryRequest $request, int $id) {
        try {
            $category = Category::findOrFail($id);
            $category->update($request->all());
            flash('Categoria atualizada com sucesso.')->success();

            return redirect('/admin/category/'.$category->id);
        } catch (\Exception $e) {
            flash('Ocorreu um erro ao atualizar a categoria.')->error();

            return redirect('/admin/category');
        }
    }

    public function destroy(int $id) {
        try {
            $category = Category::findOrFail($id);
            $category->delete();
            flash('Categoria excluída com sucesso.')->success();
        } catch (\Exception $e) {
            flash('Ocorreu um erro ao excluir a categoria.')->error();
        }
        return redirect('/admin/category');
    }

    protected function categories ()
    {
        return Category::where('category_id', '=', null)->get();
    }
}
