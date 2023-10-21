<?php

namespace App\Collections\Holding;

use App\Models\Holding;
use Illuminate\Database\Eloquent\Collection;

class HoldingCollection extends Collection
{
    public function yieldOnCost(): ?float
    {
        $sumOfProducts = $this
            ->sum(fn (Holding $holding) => $holding->yield_on_cost * $holding->invested_capital);

        if ($sumOfProducts === 0.0) {
            return null;
        }

        return $sumOfProducts / $this->sum('invested_capital');
    }
}
