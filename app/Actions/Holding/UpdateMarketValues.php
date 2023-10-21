<?php

namespace App\Actions\Holding;

use App\Models\Holding;
use App\Services\MarketStack\MarketStackService;

class UpdateMarketValues
{
    public function __construct(private readonly MarketStackService $marketStackService)
    {
    }

    public function execute()
    {
        foreach (Holding::with('stock')->get() as $holding) {
            $price = $this->marketStackService->price($holding->stock->ticker);
            $holding->market_value = $holding->quantity * $price;
            $holding->save();
        }
    }
}
