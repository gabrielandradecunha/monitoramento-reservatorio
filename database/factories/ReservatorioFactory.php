<?php

namespace Database\Factories;

use App\Models\Reservatorio;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reservatorio>
 */
class ReservatorioFactory extends Factory
{
    protected $model = Reservatorio::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(), // Cria um usuário associado automaticamente
            'nome' => $this->faker->word() . ' Reservatório',
            'volume_maximo' => $this->faker->randomFloat(2, 5000, 20000),
            'volume_atual' => $this->faker->randomFloat(2, 0, 10000),
            'ultima_atualizacao' => now(),
        ];
    }
}
