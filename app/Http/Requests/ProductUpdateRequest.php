<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'min:3|required',
            'featured' => 'boolean',
            'active' => 'boolean',
            'categories' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'O campo nome é obrigatório',
            'name.min' => 'É necessário digitar pelo menos 3 caracteres para criar um nome válido',
            'featured.boolean' => 'O campo em destaque deve ser um true ou false',
            'active.boolean' => 'O campo ativo deve ser um true ou false',
            'categories.required' => 'O campo categorias é obrigatório'
        ];
    }
}
