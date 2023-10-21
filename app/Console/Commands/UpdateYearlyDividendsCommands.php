<?php

namespace App\Console\Commands;

use App\Actions\Dividend\UpdateYearlyDividends;
use Illuminate\Console\Command;

class UpdateYearlyDividendsCommands extends Command
{
    protected $signature = 'market-stack:update-dividends';
    protected $description = "Update every stock's dividend per year value from Market Stack";

    public function handle(UpdateYearlyDividends $updateYearlyDividends)
    {
        $updateYearlyDividends->execute();

        return Command::SUCCESS;
    }
}
