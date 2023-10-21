<?php

namespace App\Actions\Dividend;

use App\DataTransferObjects\Dividend\DividendPayoutData;
use App\Models\DividendPayout;

class UpsertDividendPayout
{
    public function execute(DividendPayoutData $data): DividendPayout
    {
        return DividendPayout::updateOrCreate(
            [
                'paid_at' => $data->date,
                'user_id' => $data->user->id,
                'holding_id' => $data->holding?->id,
            ],
            [
                'amount' => $data->total_amount,
            ],
        );
    }
}
