<?php

namespace App\Console\Commands;

use App\Actions\Dividend\ImportDividendPayouts;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ImportDividendPayoutsCommand extends Command
{
    protected $signature = 'dividend:import {user}';
    protected $description = 'Import dividend payouts from CSV';

    public function handle(ImportDividendPayouts $importDividendPayouts)
    {
        DB::transaction(function () use ($importDividendPayouts) {
            $user = User::findOrFail($this->argument('user'));
            $importDividendPayouts->execute($user);

            return Command::SUCCESS;
        });
    }
}
