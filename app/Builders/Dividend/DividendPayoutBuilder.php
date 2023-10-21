<?php

namespace App\Builders\Dividend;

use App\DataTransferObjects\Dividend\MonthlyDividendData;
use App\Models\User;
use App\Filters\DateFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class DividendPayoutBuilder extends Builder
{
    public function wherePayDateBetween(?DateFilter $dates): self
    {
        if ($dates) {
            return $this->whereBetween('paid_at', [$dates->startDate, $dates->endDate]);
        }

        return $this;
    }

    /**
     * @return Collection<MonthlyDividendData>
     */
    public function monthly(User $user): Collection
    {
        return DB::table('dividend_payouts')
            ->select(DB::raw("date_format(paid_at, '%Y-%m') as month, sum(amount) as amount"))
            ->whereUserId($user->id)
            ->groupByRaw("date_format(paid_at, '%Y-%m')")
            ->orderByDesc('paid_at')
            ->get()
            ->map(fn (object $data) => MonthlyDividendData::from((array) $data));
    }

    public function allTime(User $user): float
    {
        $dates = DateFilter::fromCarbons(now()->startOfCentury(), today());
        return $this->sumByDate($dates, $user);
    }

    public function thisWeek(User $user): float
    {
        $dates = DateFilter::fromCarbons(now()->startOfWeek(), now()->endOfWeek());
        return $this->sumByDate($dates, $user);
    }

    public function thisMonth(User $user): float
    {
        $dates = DateFilter::fromCarbons(now()->startOfMonth(), now()->endOfMonth());
        return $this->sumByDate($dates, $user);
    }

    public function thisYear(User $user): float
    {
        $dates = DateFilter::fromCarbons(now()->startOfYear(), now()->endOfYear());
        return $this->sumByDate($dates, $user);
    }

    public function sumByDate(DateFilter $dates, User $user): float
    {
        return $this->whereBelongsTo($user)
            ->wherePayDateBetween($dates)
            ->sum('amount');
    }
}
