<?php

namespace Tests;

use App\Actions\Dividend\ImportDividendPayouts;
use App\Actions\Transaction\ImportTransactions;
use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function bindTransactionCsvPath(string $csvPath)
    {
        $this->app->when(ImportTransactions::class)
            ->needs('$csvPath')
            ->give($csvPath);
    }

    public function bindDividendCsvPath(string $csvPath)
    {
        $this->app->when(ImportDividendPayouts::class)
            ->needs('$csvPath')
            ->give($csvPath);
    }
}
