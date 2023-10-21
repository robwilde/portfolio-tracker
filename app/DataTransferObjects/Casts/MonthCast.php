<?php

namespace App\DataTransferObjects\Casts;

use Carbon\Carbon;
use Spatie\LaravelData\Casts\Cast;
use Spatie\LaravelData\Support\DataProperty;

class MonthCast implements Cast
{
    public function cast(DataProperty $property, mixed $value): string
    {
        return Carbon::parse($value)->format('M, Y');
    }
}
