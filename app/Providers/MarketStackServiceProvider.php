<?php

namespace App\Providers;

use App\Services\MarketStack\MarketStackService;
use Illuminate\Support\ServiceProvider;

class MarketStackServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        $this->app->singleton(MarketStackService::class, fn () => new MarketStackService(
            config('services.market_stack.uri'),
            config('services.market_stack.access_key'),
            config('services.market_stack.timeout'),
        ));
    }
}
