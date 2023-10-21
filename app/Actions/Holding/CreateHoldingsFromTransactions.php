<?php

namespace App\Actions\Holding;

use App\Collections\Transaction\TransactionCollection;
use App\Models\Holding;
use App\Models\User;
use Illuminate\Support\Collection;

class CreateHoldingsFromTransactions
{
    public function execute(TransactionCollection $transactions, User $user): Collection
    {
        return $transactions->groupBy('stock_id')
            ->filter(function (TransactionCollection $transactions, int $stockId) use ($user) {
                // To handle rounding problems
                if ($transactions->sumQuantity() <= 0.001 || $transactions->sum('total_price') <= 0.001) {
                    Holding::whereBelongsTo($user)->whereStockId($stockId)->delete();
                    return false;
                }

                return true;
            })
            ->map(fn (TransactionCollection $transactions, int $stockId) => Holding::updateOrCreate(
                [
                    'stock_id' => $stockId,
                    'user_id' => $user->id,
                ],
                [
                    'average_cost' => $transactions->weightedPricePerShare(),
                    'quantity' => $transactions->sumQuantity(),
                    'invested_capital' => $transactions->sumTotalPrice(),
                    'ticker' => $transactions->first()->stock->ticker,
                ]
            ));
    }
}
