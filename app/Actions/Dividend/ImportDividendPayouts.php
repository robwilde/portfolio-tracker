<?php

namespace App\Actions\Dividend;

use App\DataTransferObjects\Dividend\DividendPayoutData;
use App\Models\Holding;
use App\Models\User;
use App\Services\CsvService;
use Illuminate\Support\Collection;

class ImportDividendPayouts
{
    public function __construct(
        private readonly string $csvPath,
        private readonly CsvService $csvService,
        private readonly UpsertDividendPayout $upsertDividendPayout,
    ) {}

    public function execute(User $user): Collection
    {
        return $this->csvService->read($this->csvPath)
            ->filter(fn (array $data) => $data['type'] === 'DIVIDEND')
            ->map(fn (array $data) => [
                ...$data,
                'holding' => Holding::whereTicker($data['ticker'])->whereBelongsTo($user)->first(),
                'user' => $user,
            ])
            ->filter(fn (array $data) => $data['holding'])
            ->map(fn (array $data) => DividendPayoutData::from($data))
            ->map(fn (DividendPayoutData $data) => $this->upsertDividendPayout->execute($data));
    }
}
