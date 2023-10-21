<?php

namespace App\Console\Commands;

use App\Actions\Holding\CreateHoldingsFromTransactions;
use App\Actions\Portfolio\SyncAggregatePortfolios;
use App\Actions\Portfolio\UpdatePortfolioValues;
use App\Actions\Transaction\ImportTransactions;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ImportTransactionsCommand extends Command
{
    protected $signature = 'transaction:import {user}';
    protected $description = 'Import transactions from CSV';

    public function handle(
        ImportTransactions $importTransactions,
        CreateHoldingsFromTransactions $createHoldingsFromTransactions,
        UpdatePortfolioValues $updatePortfolioValues,
        SyncAggregatePortfolios $syncAggregatePortfolios
    ): int {
        return DB::transaction(function () use ($importTransactions, $createHoldingsFromTransactions, $updatePortfolioValues, $syncAggregatePortfolios) {
            $user = User::findOrFail($this->argument('user'));

            $newTransactions = $importTransactions->execute($user);
            $transactions = Transaction::with('stock')->whereIn('stock_id', $newTransactions->pluck('stock_id'))->get();
            $createHoldingsFromTransactions->execute($transactions, $user);

            $updatePortfolioValues->execute();
            $syncAggregatePortfolios->execute();

            return Command::SUCCESS;
        });
    }
}
