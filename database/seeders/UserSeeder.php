<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
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
        // Criação de um usuário de teste
        User::create([
            'name' => 'Gabriel Andrade Cunha',
            'email' => 'gandradecortez50@gmail.com',
            'password' => Hash::make('gabriel123'),  
        ]);
    }
}
