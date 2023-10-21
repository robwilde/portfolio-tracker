<?php

namespace App\Services\MarketStack\Collections;

use Illuminate\Support\Collection;

class DividendCollection extends Collection
{
    public function sumOfLast(int $months): float
    {
        return $this->take($months)->sum('dividend');
    }
}
