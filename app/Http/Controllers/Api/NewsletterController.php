<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\NewsletterRequest;
use App\Models\Newsletter;

class NewsletterController extends Controller
{
    public function store(NewsletterRequest $request)
    {
        $data = $request->only("name", "email", "active");

        try {
            Newsletter::create([
                "name" => $data["name"],
                "email" => $data["email"],
                "active" => 1,
            ]);
            return response()->json([
                'code' => 201,
                'message' => 'Cadastro realizado com sucesso',
            ])->setStatusCode(201);
        } catch (\Exception $e) {
            return response()->json([
                'code' => $e->getCode(),
                'message' => 'Ocorreu um erro ao cadastrar seu email, tente novamente mais tarde.',
            ])->setStatusCode($e->getCode());
        }
    }
}
