<?php

namespace App\Actions\Portfolio;

use App\Models\Portfolio;
use Illuminate\Support\Collection;

class SyncAggregatePortfolios
{
    public function execute(): void
    {
        Portfolio::whereName(Portfolio::AGGREGATE_NAME)->delete();

        Portfolio::all()
            ->groupBy('user_id')
            ->map(function (Collection $portfolios) {
                return [
                    'invested_capital' => $portfolios->reduce(fn (float $sumInvestedCapital, Portfolio $portfolio) => $sumInvestedCapital + $portfolio->invested_capital, 0),
                    'market_value' => $portfolios->reduce(fn (float $sumMarketValue, Portfolio $portfolio) => $sumMarketValue + $portfolio->market_value, 0),
                ];
            })
            ->each(function (array $data, int $userId) {
                Portfolio::create([
                    'name' => Portfolio::AGGREGATE_NAME,
                    'invested_capital' => $data['invested_capital'],
                    'market_value' => $data['market_value'],
                    'user_id' => $userId,
                ]);
            });
    }
}
