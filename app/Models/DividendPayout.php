<?php

namespace App\Models;

use App\Builders\Dividend\DividendPayoutBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DividendPayout extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $dates = [
        'paid_at',
    ];

    public function holding(): BelongsTo
    {
        return $this->belongsTo(Holding::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function newEloquentBuilder($query): DividendPayoutBuilder
    {
        return new DividendPayoutBuilder($query);
    }
}
