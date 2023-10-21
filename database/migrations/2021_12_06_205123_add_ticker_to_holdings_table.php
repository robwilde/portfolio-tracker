<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTickerToHoldingsTable extends Migration
{
    public function up()
    {
        Schema::table('holdings', function (Blueprint $table) {
            $table->string('ticker', 10)->after('stock_id');
        });
    }

    public function down()
    {
        Schema::table('holdings', function (Blueprint $table) {
            $table->dropColumn('ticker');
        });
    }
}
