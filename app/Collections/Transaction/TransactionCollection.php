<?php

namespace App\Collections\Transaction;

use App\Models\Transaction;
use Illuminate\Database\Eloquent\Collection;

class TransactionCollection extends Collection
{
    public function sumQuantity(): float
    {
        return $this->sum('quantity');
    }

    public function sumTotalPrice(): float
    {
        return $this->sum('total_price');
    }

    public function weightedPricePerShare(): float
    {
        $sumOfProducts = $this
            ->sum(fn (Transaction $transaction) => $transaction->quantity * $transaction->price_per_share);

        if ($this->sumQuantity() === 0.00) {
            return 0;
        }

        return $sumOfProducts / $this->sumQuantity();
    }
}
