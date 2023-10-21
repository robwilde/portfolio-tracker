<?php

namespace App\DataTransferObjects\Transaction;

use App\Models\Stock;
use App\Models\User;
use App\Enums\TransactionTypes;
use Carbon\Carbon;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\EnumCast;
use Spatie\LaravelData\Data;

class TransactionData extends Data
{
    public string $ticker;
    public float $quantity;
    public float $price_per_share;
    public int $import_id;
    public Carbon $date;
    public Stock $stock;
    public User $user;
    #[WithCast(EnumCast::class, TransactionTypes::class)]
    public TransactionTypes $type;
}
