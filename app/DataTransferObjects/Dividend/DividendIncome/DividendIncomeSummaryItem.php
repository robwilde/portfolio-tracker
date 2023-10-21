<?php

namespace App\DataTransferObjects\Dividend\DividendIncome;

use Spatie\LaravelData\Data;

class DividendIncomeSummaryItem extends Data
{
    public function __construct(
        public readonly string $value,
        public readonly string $label,
    ) {}
}
