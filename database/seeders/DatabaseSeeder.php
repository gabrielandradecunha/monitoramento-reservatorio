<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Reservatorio;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Criação de um usuário administrador
        $admin = User::factory()->create([
            'name' => 'Administrador',
            'email' => 'admin@email.com',
            'password' => Hash::make('admin'),
            'is_admin' => true
        ]);

        // Criação do reservatório diretamente associado ao administrador
        Reservatorio::factory()->create([
            'user_id' => $admin->id, // Associando ao usuário criado
            'nome' => 'Reservatório Local',
            'volume_maximo' => 10000.00,
            'volume_atual' => 7500.50,
            'ultima_atualizacao' => now(),
        ]);
        // Criação do reservatório diretamente associado ao administrador
        Reservatorio::factory()->create([
            'user_id' => $admin->id, // Associando ao usuário criado
            'nome' => 'Reservatório UFMT',
            'volume_maximo' => 10000.00,
            'volume_atual' => 5000.50,
            'ultima_atualizacao' => now(),
        ]);
        // Criação do reservatório diretamente associado ao administrador
        Reservatorio::factory()->create([
            'user_id' => $admin->id, // Associando ao usuário criado
            'nome' => 'Reservatório IFMT',
            'volume_maximo' => 10000.00,
            'volume_atual' => 500.50,
            'ultima_atualizacao' => now(),
        ]);
    }
}
