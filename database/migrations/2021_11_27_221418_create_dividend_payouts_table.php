<?php

use App\Models\Holding;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDividendPayoutsTable extends Migration
{
    public function up()
    {
        Schema::create('dividend_payouts', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Holding::class)->constrained();
            $table->float('amount', 12, 4)->nullable(false);
            $table->dateTime('paid_at')->nullable(false);
            $table->foreignIdFor(User::class)->constrained();
            $table->timestamps();

            $table->unique(['holding_id', 'user_id', 'paid_at']);
            $table->index('paid_at');
        });
    }

    public function down()
    {
        Schema::dropIfExists('dividend_payouts');
    }
}
