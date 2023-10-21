<?php

namespace Database\Factories;

use App\Models\Portfolio;
use App\Models\Stock;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class HoldingFactory extends Factory
{
    public function definition()
    {
        $averageCost = $this->faker->randomFloat(2, 10, 1000);
        $quantity = $this->faker->randomFloat(4, 0.01, 10);

        return [
            'average_cost' => $averageCost,
            'quantity' => $quantity,
            'invested_capital' => $averageCost * $quantity,
            'stock_id' => fn () => Stock::factory()->create(),
            'portfolio_id' => fn () => Portfolio::factory()->create(),
            'user_id' => fn () => User::factory()->create(),
        ];
    }
}
