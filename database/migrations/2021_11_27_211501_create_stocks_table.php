<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStocksTable extends Migration
{
    public function up()
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->string('ticker', 10)->nullable(false);
            $table->timestamps();

            $table->unique('ticker');
        });
    }

    public function down()
    {
        Schema::dropIfExists('stocks');
    }
}
