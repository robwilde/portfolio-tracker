<?php

namespace App\Models;

use App\Builders\Portfolio\PortfolioBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Support\Str;

class Portfolio extends Model
{
    use HasFactory;

    public const AGGREGATE_NAME = 'All';

    protected $guarded = [];
    protected $with = ['holdings'];

    protected static function booted()
    {
        static::saving(function (Portfolio $portfolio) {
            $portfolio->slug = Str::slug($portfolio->name);
        });
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function holdings(): HasMany
    {
        return $this->hasMany(Holding::class);
    }

    public function dividendPayouts(): HasManyThrough
    {
        return $this->hasManyThrough(DividendPayout::class, Holding::class);
    }

    public function newEloquentBuilder($query): PortfolioBuilder
    {
        return new PortfolioBuilder($query);
    }

    public function getYieldOnCostAttribute(): ?float
    {
        return $this->yieldOnCost();
    }

    public function getYieldAttribute(): ?float
    {
        return $this->market_value / $this->invested_capital - 1;
    }

    public function getIsAggregateAttribute(): bool
    {
        return $this->name === self::AGGREGATE_NAME;
    }

    public function toArray(): array
    {
        return [
            ...parent::toArray(),
            'yield' => $this->yield,
            'yield_on_cost' => $this->yield_on_cost,
            'is_aggregate' => $this->is_aggregate,
        ];
    }
}
