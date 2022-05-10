<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewsletterRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'min:3|max:60|required',
            'email' => 'required|email|min:6|max:60'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'O campo nome é obrigatório',
            'name.min' => 'É necessário digitar pelo menos 3 caracteres para criar um nome válido',
            'name.max' => 'O campo nome só permite no máximo 60 caracteres',
            'email.required' => 'O campo email é obrigatório',
            'email.min' => 'É necessário digitar pelo menos 6 caracteres para criar um nome válido',
            'email.email' => 'O campo email não possui um email válido',
            'email.max' => 'O campo email só permite no máximo 60 caracteres',
        ];
    }
}
