<?php

namespace App\Models;

use App\Builders\Holding\HoldingBuilder;
use App\Collections\Holding\HoldingCollection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Holding extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];
    protected $with = ['stock'];

    public function stock(): BelongsTo
    {
        return $this->belongsTo(Stock::class);
    }

    public function dividendPayouts(): HasMany
    {
        return $this->hasMany(DividendPayout::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function portfolio(): BelongsTo
    {
        return $this->belongsTo(Portfolio::class);
    }

    public function newEloquentBuilder($query): HoldingBuilder
    {
        return new HoldingBuilder($query);
    }

    public function newCollection(array $models = []): HoldingCollection
    {
        return new HoldingCollection($models);
    }

    public function getYieldOnCostAttribute(): float
    {
        if (!$this->stock->dividend_amount_per_year) {
            return 0;
        }

        return $this->stock->dividend_amount_per_year / $this->average_cost;
    }

    public function getYieldAttribute(): float
    {
        return $this->market_value / $this->invested_capital - 1;
    }

    public function toArray(): array
    {
        return [
            ...parent::toArray(),
            'yield' => $this->yield,
            'yield_on_cost' => $this->yield_on_cost,
        ];
    }
}
