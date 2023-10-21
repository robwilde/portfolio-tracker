<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDividendFieldsToStocksTable extends Migration
{
    public function up()
    {
        Schema::table('stocks', function (Blueprint $table) {
            $table->float('dividend_amount_per_year', 8, 4)
                ->unsigned()
                ->nullable(true);

            $table
                ->integer('dividend_times_per_year')
                ->unsigned()
                ->nullable(false)
                ->default(4)
                ->after('dividend_amount_per_year');
        });
    }

    public function down()
    {
        Schema::table('stocks', function (Blueprint $table) {
            $table->dropColumn('dividend_amount_per_year');
            $table->dropColumn('dividend_times_per_year');
        });
    }
}
