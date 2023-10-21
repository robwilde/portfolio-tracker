<?php

namespace Database\Factories;

use App\Models\Holding;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class DividendPayoutFactory extends Factory
{
    public function definition()
    {
        return [
            'amount' => $this->faker->randomFloat(2, 0.1, 5),
            'paid_at' => now()->addDay(rand(-730, 0))->hour(rand(0, 24))->minute(rand(0, 59))->second(rand(0, 59)),
            'user_id' => fn () => User::factory()->create(),
            'holding_id' => fn() => Holding::factory()->create(),
        ];
    }
}
