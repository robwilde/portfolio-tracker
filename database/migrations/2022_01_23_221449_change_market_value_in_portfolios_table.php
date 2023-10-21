<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeMarketValueInPortfoliosTable extends Migration
{
    public function up()
    {
        Schema::table('portfolios', function (Blueprint $table) {
            $table->float('market_value')->unsigned()->nullable(false)->default(0)->after('invested_capital')->change();
        });
    }

    public function down()
    {
        Schema::table('portfolios', function (Blueprint $table) {
            $table->float('market_value')->unsigned()->nullable(true)->after('invested_capital')->change();
        });
    }
}
