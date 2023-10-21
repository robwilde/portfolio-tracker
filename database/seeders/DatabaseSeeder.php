<?php

namespace Database\Seeders;

use App\Actions\Portfolio\SyncAggregatePortfolios;
use App\Actions\Portfolio\UpdatePortfolioValues;
use App\Models\Holding;
use App\Models\Portfolio;
use App\Models\Stock;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(UpdatePortfolioValues $updatePortfolioValues, SyncAggregatePortfolios $syncAggregatePortfolios)
    {
        $user = User::factory([
            'email' => 'demo@portfolio.com',
            'name' => 'Demo User',
            'password' => Hash::make('password'),
        ])->create();

        foreach (['Dividend Stocks', 'Growth Stocks'] as $name) {
            Portfolio::firstOrCreate([
                'name' => $name,
                'slug' => Str::slug($name),
                'user_id' => $user->id,
            ]);
        }

        $growthTickers = ['GOOGL', 'FB', 'SQ', 'PYPL', 'NFLX', 'AMZN', 'CRM', 'TWLO', 'DIS', 'SPOT'];

        $growthPortfolio = Portfolio::whereSlug('growth-stocks')->first();
        $dividendPortfolio = Portfolio::whereSlug('dividend-stocks')->first();

        Artisan::call('transaction:import', [
            'user' => $user->id,
        ]);
        Artisan::call('dividend:import', [
            'user' => $user->id,
        ]);

        Holding::whereIn('ticker', $growthTickers)
            ->update([
                'portfolio_id' => $growthPortfolio->id
            ]);

        Holding::whereNotIn('ticker', $growthTickers)
            ->update([
                'portfolio_id' => $dividendPortfolio->id
            ]);

        if (config('services.market_stack.access_key')) {
            Artisan::call('market-stack:update-market-values');
            Artisan::call('market-stack:update-dividends');
        } else {
            foreach (Holding::all() as $holding) {
                $holding->market_value = $holding->invested_capital * 1.1;
                $holding->save();
            }

            Stock::whereNotIn('ticker', $growthTickers)
                ->update([
                    'dividend_amount_per_year' => 1,
                ]);
        }

        $updatePortfolioValues->execute();
        $syncAggregatePortfolios->execute();
    }
}
