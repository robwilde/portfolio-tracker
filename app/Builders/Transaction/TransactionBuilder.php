<?php

namespace App\Builders\Transaction;

use App\DataTransferObjects\Portfolio\InvestedCapitalData;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class TransactionBuilder extends Builder
{
    /**
     * @return Collection<InvestedCapitalData>
     */
    public function monthly(User $user): Collection
    {
        return DB::table('transactions')
            ->select(DB::raw("date_format(date, '%Y-%m') as month, sum(total_price) as amount"))
            ->whereUserId($user->id)
            ->groupByRaw("date_format(date, '%Y-%m')")
            ->orderByDesc('date')
            ->get()
            ->map(fn (object $data) => InvestedCapitalData::from((array) $data));
    }
}
