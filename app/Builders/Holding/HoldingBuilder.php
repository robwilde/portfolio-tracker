<?php

namespace App\Builders\Holding;

use Illuminate\Database\Eloquent\Builder;

class HoldingBuilder extends Builder
{
    public function whereTicker(string $ticker): self
    {
        return $this->whereRelation('stock', 'ticker', $ticker);
    }
}
