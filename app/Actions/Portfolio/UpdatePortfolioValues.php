<?php

namespace App\Actions\Portfolio;

use App\Models\Portfolio;

class UpdatePortfolioValues
{
    public function execute()
    {
        Portfolio::all()->each(function (Portfolio $portfolio) {
            $portfolio->invested_capital = $portfolio->holdings()->sum('invested_capital');
            $portfolio->market_value = $portfolio->holdings()->sum('market_value');
            $portfolio->save();
        });
    }
}
