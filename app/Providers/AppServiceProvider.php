<?php

namespace App\Providers;

use App\Actions\Dividend\ImportDividendPayouts;
use App\Actions\Transaction\ImportTransactions;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        $this->app->when(ImportTransactions::class)
            ->needs('$csvPath')
            ->give(storage_path(config('imports.transaction.storage_path')));

        $this->app->when(ImportDividendPayouts::class)
            ->needs('$csvPath')
            ->give(storage_path(config('imports.dividend.storage_path')));

        // DB::listen(function ($query) {
        //     logger(Str::replaceArray('?', $query->bindings, $query->sql));
        // });

        JsonResource::wrap(null);
    }
}
