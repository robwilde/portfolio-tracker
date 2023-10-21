<?php

use App\Models\Stock;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Stock::class)->constrained();
            $table->string('type', 10)->nullable(false);        // sell or buy
            $table->float('quantity', 8, 4)->nullable(false);
            $table->float('price_per_share')->nullable(false);
            $table->float('total_price')->nullable(false);
            $table->foreignIdFor(User::class)->constrained();
            $table->unsignedBigInteger('import_id')->nullable(false);
            $table->timestamps();

            $table->unique(['user_id', 'import_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
