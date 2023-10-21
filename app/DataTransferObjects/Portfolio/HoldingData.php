<?php

namespace App\DataTransferObjects\Portfolio;

use App\DataTransferObjects\Casts\MoneyCast;
use App\DataTransferObjects\Casts\PercentCast;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Data;

class HoldingData extends Data
{
    public function __construct(
        public readonly string $id,
        public readonly string $ticker,
        public readonly string $quantity,
        #[WithCast(MoneyCast::class)]
        public readonly string $average_cost,
        #[WithCast(MoneyCast::class)]
        public readonly string $invested_capital,
        #[WithCast(MoneyCast::class)]
        public readonly string $market_value,
        #[WithCast(PercentCast::class)]
        public readonly string $yield,
        #[WithCast(PercentCast::class)]
        public readonly string $yield_on_cost,
    ) {}
}
