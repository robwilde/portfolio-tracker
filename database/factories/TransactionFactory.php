<?php

namespace Database\Factories;

use App\Models\User;
use App\Enums\TransactionTypes;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionFactory extends Factory
{
    public function definition()
    {
        return [
            'type' => rand(0, 3) === 0 ? TransactionTypes::SELL : TransactionTypes::BUY,
            'quantity' => $this->faker->randomFloat(4, 0.01, 10),
            'total_price' => $this->faker->randomFloat(2, 10, 1000),
            'price_per_share' => $this->faker->randomFloat(2, 1, 100),
            'user_id' => fn () => User::factory()->create(),
            'import_id' => fn () => rand(1, 10000000),
        ];
    }
}
