<?php

namespace App\DataTransferObjects\Portfolio;

use App\DataTransferObjects\Casts\MoneyCast;
use App\DataTransferObjects\Casts\MonthCast;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Data;

class InvestedCapitalData extends Data
{
    public function __construct(
        #[WithCast(MoneyCast::class)]
        public readonly string $amount,
        #[WithCast(MonthCast::class)]
        public readonly string $month,
    ) {}
}
