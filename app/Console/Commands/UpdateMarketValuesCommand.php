<?php

namespace App\Console\Commands;

use App\Actions\Holding\UpdateMarketValues;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class UpdateMarketValuesCommand extends Command
{
    protected $signature = 'market-stack:update-market-values';
    protected $description = "Update every holding's market value from Market Stack";

    public function handle(UpdateMarketValues $updateMarketValues)
    {
        $updateMarketValues->execute();

        Artisan::call('portfolio:sync');

        return Command::SUCCESS;
    }
}
