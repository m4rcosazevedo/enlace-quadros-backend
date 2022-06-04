<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FileUpdateRequest extends FormRequest
{
    public function rules()
    {
        return [
            'filename' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'description.required' => 'O campo descrição é obrigatório',
            'filename.mimes' => 'Só é permitida as seguintes extensões: jpeg,png,jpg,gif',
            'filename.image' => 'A imagem não é válida'
        ];
    }
}
