<?php

namespace App\Services\MarketStack\DataTransferObjects;

use Carbon\Carbon;

class DividendData
{
    public function __construct(
        public readonly Carbon $date,
        public readonly float $dividend,
    ) {}

    public static function fromArray(array $data): self
    {
        return new static(
            Carbon::parse($data['date']),
            $data['dividend'],
        );
    }
}
