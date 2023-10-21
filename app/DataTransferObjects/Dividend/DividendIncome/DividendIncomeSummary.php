<?php

namespace App\DataTransferObjects\Dividend\DividendIncome;

use Spatie\LaravelData\Data;

class DividendIncomeSummary extends Data
{
    public function __construct(
        public readonly DividendIncomeSummaryItem $thisWeek,
        public readonly DividendIncomeSummaryItem $thisMonth,
        public readonly DividendIncomeSummaryItem $thisYear,
        public readonly DividendIncomeSummaryItem $allTime,
    ) {}
}
