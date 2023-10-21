<?php

namespace App\DataTransferObjects\Dividend;

use App\Models\Holding;
use App\Models\User;
use Carbon\Carbon;
use Spatie\LaravelData\Data;

class DividendPayoutData extends Data
{
    public function __construct(
        public readonly Carbon $date,
        public readonly Holding $holding,
        public readonly float $total_amount,
        public readonly User $user,
    ) {}
}
