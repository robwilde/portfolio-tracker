<?php

namespace Tests\Feature\Transaction;

use App\Models\Stock;
use App\Models\DividendPayout;
use App\Models\Holding;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Artisan;

it('should import payouts from a csv', function () {
    $this->bindDividendCsvPath(storage_path('test/dividend_payouts_import.csv'));
    $avgo = Stock::factory(['ticker' => 'AVGO'])->create();
    $vici = Stock::factory(['ticker' => 'VICI'])->create();

    $user = User::factory()
        ->has(Holding::factory(['stock_id' => $avgo->id]))
        ->has(Holding::factory(['stock_id' => $vici->id]))
        ->create();

    Artisan::call("dividend:import {$user->id}");

    expect($user->dividendPayouts->count())
        ->toBe(2);

    $dividendPayouts = DividendPayout::all();
    expect($dividendPayouts->pluck('amount'))
        ->sequence(
            1.2900,
            3.4900,
        );

    expect($dividendPayouts->pluck('paid_at'))
        ->sequence(
            Carbon::parse('2021-10-01 05:28:10'),
            Carbon::parse('2021-10-08 05:16:12'),
        );
});
