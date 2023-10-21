<?php

namespace App\DataTransferObjects\Casts;

use App\ValueObjects\Numbers\Money;
use Spatie\LaravelData\Casts\Cast;
use Spatie\LaravelData\Support\DataProperty;

class MoneyCast implements Cast
{
    public function cast(DataProperty $property, mixed $value): string
    {
        return Money::from($value)->format();
    }
}
