<?php

namespace App\Models;

use App\Builders\Transaction\TransactionBuilder;
use App\Enums\TransactionTypes;
use App\Collections\Transaction\TransactionCollection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function stock(): BelongsTo
    {
        return $this->belongsTo(Stock::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function newEloquentBuilder($query): TransactionBuilder
    {
        return new TransactionBuilder($query);
    }

    public function newCollection(array $models = []): TransactionCollection
    {
        return new TransactionCollection($models);
    }

    protected static function booted()
    {
        self::saving(function (Transaction $transaction) {
            if ($transaction->type === TransactionTypes::SELL->value && $transaction->quantity > 0) {
                $transaction->quantity *= -1;
            }

            $transaction->total_price = $transaction->price_per_share * $transaction->quantity;
        });
    }
}
