<?php

namespace App\Console\Commands;

use App\Actions\Portfolio\SyncAggregatePortfolios;
use App\Actions\Portfolio\UpdatePortfolioValues;
use Illuminate\Console\Command;

class SyncPortfoliosCommand extends Command
{
    protected $signature = 'portfolio:sync';
    protected $description = "Sync portolios' invested capital with holdings and recreates aggregate portolios";

    public function handle(UpdatePortfolioValues $updatePortfolioValues, SyncAggregatePortfolios $syncAggregatePortfolios)
    {
        $updatePortfolioValues->execute();

        $syncAggregatePortfolios->execute();

        return Command::SUCCESS;
    }
}
