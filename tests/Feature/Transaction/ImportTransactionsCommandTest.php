<?php

namespace Tests\Feature\Transaction;

use App\Models\Stock;
use App\Models\Transaction;
use App\Enums\TransactionTypes;
use App\Models\Holding;
use App\Models\User;
use Illuminate\Support\Facades\Artisan;

it('should import a basic csv', function () {
    $this->bindTransactionCsvPath(storage_path('test/transaction_import_basic.csv'));
    $user = User::factory()->create();

    Artisan::call("transaction:import {$user->id}");

    expect(Stock::first())
        ->ticker->toBe('NFLX');

    expect($user->holdings->first())
        ->quantity->toBe(10.00)
        ->average_cost->toBe(497.00)
        ->invested_capital->toBe(4970.00);
});

it('should import an advanced csv', function () {
    $this->bindTransactionCsvPath(storage_path('test/transaction_import_advanced.csv'));
    $user = User::factory()->create();

    Artisan::call("transaction:import {$user->id}");

    expect(Stock::first())
        ->ticker->toBe('NFLX');

    expect($user->holdings->first())
        ->quantity->toBe(3.00)
        ->average_cost->toBe(333.33)
        ->invested_capital->toBe(1000.00);
});

it('should remove a holding based on transactions', function () {
    $user = User::factory()->create();
    $nflx = Stock::factory([
        'ticker' => 'NFLX',
    ]);
    Transaction::factory([
        'stock_id' => $nflx,
        'type' => TransactionTypes::BUY,
        'quantity' => 2,
        'price_per_share' => 500,
        'total_price' => 1000,
        'user_id' => $user,
    ])->create();

    $this->bindTransactionCsvPath(storage_path('test/transaction_import_sell_whole_holding.csv'));
    Artisan::call("transaction:import {$user->id}");

    expect(Stock::count())
        ->toBe(1);

    expect(Holding::count())
        ->toBe(0);
});

it('should not override the same transactions', function () {
    $user = User::factory()->create();
    $this->bindTransactionCsvPath(storage_path('test/transaction_import_basic.csv'));

    Artisan::call("transaction:import {$user->id}");
    Artisan::call("transaction:import {$user->id}");

    expect(Stock::first())
        ->ticker->toBe('NFLX');

    expect($user->holdings->first())
        ->quantity->toBe(10.00)
        ->average_cost->toBe(497.00)
        ->invested_capital->toBe(4970.00);
});
