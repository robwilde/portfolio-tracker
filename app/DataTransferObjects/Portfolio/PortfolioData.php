<?php

namespace App\DataTransferObjects\Portfolio;

use App\DataTransferObjects\Casts\MoneyCast;
use App\DataTransferObjects\Casts\PercentCast;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

class PortfolioData extends Data
{
    public function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly string $slug,
        #[WithCast(MoneyCast::class)]
        public readonly string $invested_capital,
        #[WithCast(MoneyCast::class)]
        public readonly string $market_value,
        #[WithCast(PercentCast::class)]
        public readonly ?string $yield_on_cost,
        #[WithCast(PercentCast::class)]
        public readonly ?string $yield,
        /** @var DataCollection<HoldingData> */
        public readonly DataCollection $holdings,
    ) {}
}
