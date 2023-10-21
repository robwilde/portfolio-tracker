<?php

namespace App\ViewModels;

use App\DataTransferObjects\Dividend\DividendIncome\DividendIncomeSummary;
use App\DataTransferObjects\Dividend\DividendIncome\DividendIncomeSummaryItem;
use App\DataTransferObjects\Dividend\MonthlyDividendData;
use App\DataTransferObjects\Portfolio\PortfolioData;
use App\Models\DividendPayout;
use App\Models\Portfolio;
use App\Models\User;
use App\ValueObjects\Numbers\Money;
use Spatie\LaravelData\DataCollection;

class GetDashboardViewModel extends ViewModel
{
    public function __construct(private User $user)
    {
    }

    /**
     * @return DataCollection<MonthlyDividendData>
     */
    public function monthlyDividendIncome(): DataCollection
    {
        return MonthlyDividendData::collection(DividendPayout::monthly($this->user));
    }

    /**
     * @return DataCollection<PortfolioData>
     */
    public function portfolios(): DataCollection
    {
        return PortfolioData::collection(
            Portfolio::whereBelongsTo($this->user)
                ->orderByDesc('invested_capital')
                ->get()
        );
    }

    public function dividendIncomeSummary(): DividendIncomeSummary
    {
        return new DividendIncomeSummary(
            thisWeek: new   DividendIncomeSummaryItem(
                value: Money::from(DividendPayout::thisWeek($this->user))->format(),
                label: 'This Week',
            ),
            thisMonth: new DividendIncomeSummaryItem(
                value: Money::from(DividendPayout::thisMonth($this->user))->format(),
                label: 'This Month',
            ),
            thisYear: new DividendIncomeSummaryItem(
                value: Money::from(DividendPayout::thisYear($this->user))->format(),
                label: 'This Year',
            ),
            allTime: new DividendIncomeSummaryItem(
                value: Money::from(DividendPayout::allTime($this->user))->format(),
                label: 'All Time',
            ),
        );
    }
}
