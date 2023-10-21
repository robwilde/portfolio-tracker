<?php

namespace App\DataTransferObjects\Casts;

use App\ValueObjects\Numbers\Percent;
use Spatie\LaravelData\Casts\Cast;
use Spatie\LaravelData\Support\DataProperty;

class PercentCast implements Cast
{
    public function cast(DataProperty $property, mixed $value): string
    {
        return Percent::from($value)->format();
    }
}
