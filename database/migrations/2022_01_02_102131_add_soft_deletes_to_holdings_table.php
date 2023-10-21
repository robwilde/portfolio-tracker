<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSoftDeletesToHoldingsTable extends Migration
{
    public function up()
    {
        Schema::table('holdings', function (Blueprint $table) {
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::table('holdings', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
}
