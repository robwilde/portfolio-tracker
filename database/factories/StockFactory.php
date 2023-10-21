<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class StockFactory extends Factory
{
    public function definition()
    {
        return [
            'ticker' => Str::of($this->faker->unique(true)->word)->substr(0, 5)->upper()->append(rand(10, 999)),
        ];
    }
}
