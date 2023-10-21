<?php

namespace App\ViewModels;

use App\DataTransferObjects\Portfolio\InvestedCapitalData;
use App\Models\Transaction;
use App\Models\User;
use Spatie\LaravelData\DataCollection;

class GetInvestedCapitalViewModel extends ViewModel
{
    public function __construct(private User $user)
    {
    }

    /**
     * @return DataCollection<InvestedCapitalData>
     */
    public function monthly(): DataCollection
    {
        return InvestedCapitalData::collection(Transaction::monthly($this->user));
    }
}
