<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeMarketValueInHoldingsTable extends Migration
{
    public function up()
    {
        Schema::table('holdings', function (Blueprint $table) {
            $table->float('market_value')->unsigned()->nullable(false)->default(0)->after('invested_capital')->change();
        });
    }

    public function down()
    {
        Schema::table('holdings', function (Blueprint $table) {
            $table->float('market_value')->unsigned()->nullable(true)->after('invested_capital')->change();
        });
    }
}
