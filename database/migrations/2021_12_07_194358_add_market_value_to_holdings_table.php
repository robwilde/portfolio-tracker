<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMarketValueToHoldingsTable extends Migration
{
    public function up()
    {
        Schema::table('holdings', function (Blueprint $table) {
            $table->float('market_value')->unsigned()->nullable(true)->after('invested_capital');
        });
    }

    public function down()
    {
        Schema::table('holdings', function (Blueprint $table) {
            $table->dropColumn('market_value');
        });
    }
}
