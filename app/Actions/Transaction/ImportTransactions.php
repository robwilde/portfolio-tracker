<?php

namespace App\Actions\Transaction;

use App\Collections\Transaction\TransactionCollection;
use App\DataTransferObjects\Transaction\TransactionData;
use App\Enums\TransactionTypes;
use App\Models\Stock;
use App\Models\User;
use App\Services\CsvService;

class ImportTransactions
{
    public function __construct(
        private string $csvPath,
        private CsvService $csvService,
        private UpsertTransaction $upsertTransaction,
    ) {}

    public function execute(User $user): TransactionCollection
    {
        $transactions = $this->csvService->read($this->csvPath)
            ->filter(fn (array $data) => $data['type'] === TransactionTypes::SELL->value || $data['type'] === TransactionTypes::BUY->value)
            ->map(fn (array $data) => [
                ...$data,
                'stock' => Stock::firstOrCreate(['ticker' => $data['ticker']]),
                'user' => $user,
            ])
            ->map(fn (array $data) => TransactionData::from($data))
            ->map(fn (TransactionData $data) => $this->upsertTransaction->execute($data));

        return new TransactionCollection($transactions);
    }
}
