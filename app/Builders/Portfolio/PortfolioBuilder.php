<?php

namespace App\Builders\Portfolio;

use App\Models\Holding;
use Illuminate\Database\Eloquent\Builder;

class PortfolioBuilder extends Builder
{
    public function yieldOnCost(): ?float
    {
        $holdings = $this->model->is_aggregate
            ? Holding::whereBelongsTo($this->model->user)->get()
            : $this->model->holdings;

        return $holdings->yieldOnCost();
    }
}
