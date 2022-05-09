<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'min:3|required',
            'category_id' => 'integer|exists:categories,id',
            'position' => 'integer|max:99|min:0'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'O campo nome é obrigatório',
            'name.min' => 'É necessário digitar pelo menos 3 caracteres para criar um nome válido',
            'position.integer' => 'A posição tem que ser um número válido',
            'position.max' => 'O maior número permitido na posição é o 99',
            'position.min' => 'Não é permitido números negativos',
        ];
    }
}
