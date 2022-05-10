<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->users = [
            ["id" => 1, "name" => "Marcos Azevedo", "email" => "m4rcos.azevedo@gmail.com", "password" => Hash::make("m4rcos.azevedo@gmail.com")]
        ];

        if (!User::get()->count()) {
            foreach ($this->users as $user) {
                User::create($user);
            }
        }
    }
}
