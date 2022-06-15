<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SliderCreateRequest extends FormRequest
{
    public function rules()
    {
        return [
            'title' => 'min:3|required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:1000',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'O campo nome é obrigatório',
            'name.min' => 'É necessário digitar pelo menos 3 caracteres para criar um título válido',
            'image.required' => 'O campo imagem é obrigatório',
            'image.mimes' => 'Só é permitida as seguintes extensões: jpeg,png,jpg,gif',
            'image.image' => 'A imagem não é válida',
            'image.max' => 'A imagem não é pode ser maior que 1mb'
        ];
    }
}
