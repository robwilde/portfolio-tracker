<?php

use App\Models\Stock;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHoldingsTable extends Migration
{
    public function up()
    {
        Schema::create('holdings', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Stock::class)->constrained();
            $table->float('average_cost')->nullable(false);
            $table->float('quantity', 12, 4)->nullable(false);
            $table->float('invested_capital')->nullable(false);
            $table->unsignedBigInteger('portfolio_id')->nullable(true);
            $table->foreign('portfolio_id')->references('id')->on('portfolios');
            $table->foreignIdFor(User::class)->constrained();
            $table->timestamps();

            $table->unique(['user_id', 'stock_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('holdings');
    }
}
