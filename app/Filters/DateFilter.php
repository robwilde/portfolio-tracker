<?php

namespace App\Filters;

use App\ValueObjects\Date\EndDate;
use App\ValueObjects\Date\StartDate;
use Carbon\Carbon;

class DateFilter
{
    public function __construct(
        public StartDate $startDate,
        public EndDate $endDate
    ) {}

    public static function fromCarbons(
        Carbon $startDate,
        Carbon $endDate
    ): self {
        return new static(
            StartDate::fromString($startDate->toString()),
            EndDate::fromString($endDate->toString())
        );
    }
}
