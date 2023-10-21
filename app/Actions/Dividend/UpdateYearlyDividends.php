<?php

namespace App\Actions\Dividend;

use App\Models\Stock;
use App\Services\MarketStack\MarketStackService;

class UpdateYearlyDividends
{
    public function __construct(private readonly MarketStackService $marketStackService)
    {
    }

    public function execute(): void
    {
        foreach (Stock::where('dividend_times_per_year', '!=', 0)->get() as $stock) {
            $dividends = $this->marketStackService->dividends($stock->ticker);
            $stock->dividend_amount_per_year = $dividends->sumOfLast($stock->dividend_times_per_year);
            $stock->save();
        }
    }
}
