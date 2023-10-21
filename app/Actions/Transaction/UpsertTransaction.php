<?php

namespace App\Actions\Transaction;

use App\DataTransferObjects\Transaction\TransactionData;
use App\Models\Transaction;

class UpsertTransaction
{
    public function execute(TransactionData $data): Transaction
    {
        return Transaction::updateOrCreate(
            [
                'import_id' => $data->import_id,
                'user_id' => $data->user->id,
            ],
            [
                'type'  => $data->type->value,
                'quantity' => $data->quantity,
                'price_per_share' => $data->price_per_share,
                'stock_id' => $data->stock->id,
                'date' => $data->date,
            ],
        );
    }
}
