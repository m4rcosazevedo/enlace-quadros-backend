<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'min:3|required',
//            'description' => 'required',
            'image' => 'required|image|max:1024',
            'featured' => 'boolean',
            'active' => 'boolean',
            'categories' => 'required',
//            'categories.*.id' => 'required|integer|exists:categories,id',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'O campo nome é obrigatório',
            'name.min' => 'É necessário digitar pelo menos 3 caracteres para criar um nome válido',
            'description.required' => 'O campo descrição é obrigatório',
            'image.required' => 'O campo imagem é obrigatório',
            'featured.boolean' => 'O campo em destaque deve ser um true ou false',
            'active.boolean' => 'O campo ativo deve ser um true ou false',
            'categories.required' => 'O campo categorias é obrigatório'
        ];
    }
}
