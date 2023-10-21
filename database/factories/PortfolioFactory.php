<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PortfolioFactory extends Factory
{
    public function definition()
    {
        return [
            'name' => $this->faker->words(2, true),
            'invested_capital' => $this->faker->randomFloat(2, 500, 10000),
            'user_id' => fn () => User::factory()->create(),
        ];
    }
}
