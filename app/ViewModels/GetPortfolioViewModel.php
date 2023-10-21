<?php

namespace App\ViewModels;

use App\DataTransferObjects\Portfolio\HoldingData;
use App\DataTransferObjects\Portfolio\PortfolioData;
use App\Models\Holding;
use App\Models\Portfolio;
use App\Models\User;
use Spatie\LaravelData\DataCollection;

class GetPortfolioViewModel extends ViewModel
{
    public function __construct(private User $user, private Portfolio $portfolio)
    {
    }

    public function portfolio(): PortfolioData
    {
        return PortfolioData::from($this->portfolio);
    }

    /**
     * @return DataCollection<HoldingData>
     */
    public function holdings(): DataCollection
    {
        if ($this->portfolio->is_aggregate) {
            return HoldingData::collection(
                Holding::whereBelongsTo($this->user)->orderByDesc('invested_capital')->get()
            );
        }

        return HoldingData::collection($this->portfolio->holdings()->orderByDesc('invested_capital')->get());
    }
}
