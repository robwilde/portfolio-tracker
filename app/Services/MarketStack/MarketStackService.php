<?php

namespace App\Services\MarketStack;

use App\Services\MarketStack\Collections\DividendCollection;
use App\Services\MarketStack\DataTransferObjects\DividendData;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

class MarketStackService
{
    public function __construct(
        private readonly string $uri,
        private readonly string $accessKey,
        private readonly int $timeout
    ) {}

    public function dividends(string $ticker): DividendCollection
    {
        $response = $this->buildRequest()
            ->get($this->uri . 'dividends', $this->buildQuery($ticker))
            ->throw();

        $items = collect($response->json('data'))
            ->map(fn (array $item) => DividendData::fromArray($item))
            ->toArray();

        return new DividendCollection($items);
    }

    public function price(string $ticker): float
    {
        $response = $this->buildRequest()
            ->get($this->uri . 'eod', [
                'limit' => 1,
                ...$this->buildQuery($ticker),
            ])
            ->throw()
            ->json('data');

        return (float) $response[0]['close'];
    }

    private function buildRequest(): PendingRequest
    {
        return Http::withHeaders([
            'Accept' => 'application/json',
        ])->timeout($this->timeout);
    }

    private function buildQuery(string $ticker): array
    {
        return [
            'access_key' => $this->accessKey,
            'symbols' => $ticker,
        ];
    }
}
