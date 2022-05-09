<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->categories = [
            ["id" => 1, "name" => "Por cor", "category_id" => null],
            ["id" => 2, "name" => "Amarelo", "category_id" => 1],
            ["id" => 3, "name" => "Azul", "category_id" => 1],
            ["id" => 4, "name" => "Branco", "category_id" => 1],
            ["id" => 5, "name" => "Cinza", "category_id" => 1],
            ["id" => 6, "name" => "Laranja", "category_id" => 1],
            ["id" => 7, "name" => "Preto", "category_id" => 1],
            ["id" => 8, "name" => "Preto e Branco", "category_id" => 1],
            ["id" => 9, "name" => "Rosa", "category_id" => 1],
            ["id" => 10, "name" => "Roxo", "category_id" => 1],
            ["id" => 11, "name" => "Verde", "category_id" => 1],
            ["id" => 12, "name" => "Vermelho", "category_id" => 1],
            ["id" => 13, "name" => "Por Ambiente", "category_id" => null],
            ["id" => 14, "name" => "Sala", "category_id" => 13],
            ["id" => 15, "name" => "Quarto", "category_id" => 13],
            ["id" => 16, "name" => "Quarto Infantil", "category_id" => 13],
            ["id" => 17, "name" => "Banheiro", "category_id" => 13],
            ["id" => 18, "name" => "Cozinha", "category_id" => 13],
            ["id" => 19, "name" => "Varanda", "category_id" => 13],
            ["id" => 20, "name" => "Consultório", "category_id" => 13],
            ["id" => 21, "name" => "Escritório", "category_id" => 13],
            ["id" => 22, "name" => "Por Temas", "category_id" => null],
            ["id" => 23, "name" => "Amor", "category_id" => 22],
            ["id" => 24, "name" => "Signo", "category_id" => 22],
            ["id" => 25, "name" => "Esporte", "category_id" => 22],
            ["id" => 26, "name" => "Filmes e Séries", "category_id" => 22],
            ["id" => 27, "name" => "Fotografia", "category_id" => 22],
            ["id" => 28, "name" => "Frases", "category_id" => 22],
            ["id" => 29, "name" => "Abstratos", "category_id" => 22],
            ["id" => 30, "name" => "Humor", "category_id" => 22],
            ["id" => 31, "name" => "LGBT", "category_id" => 22],
            ["id" => 32, "name" => "Cidades", "category_id" => 22],
            ["id" => 33, "name" => "Minimalistas", "category_id" => 22],
            ["id" => 34, "name" => "Música", "category_id" => 22],
            ["id" => 35, "name" => "Mães", "category_id" => 22],
            ["id" => 36, "name" => "Pais", "category_id" => 22],
            ["id" => 37, "name" => "Natureza", "category_id" => 22],
            ["id" => 38, "name" => "Pôsters", "category_id" => 22],
        ];

        if (!Category::get()->count()) {
            foreach ($this->categories as $category) {
                Category::create($category);
            }
        }
    }
}
