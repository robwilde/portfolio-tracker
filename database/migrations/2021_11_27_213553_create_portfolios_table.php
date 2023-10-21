<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePortfoliosTable extends Migration
{
    public function up()
    {
        Schema::create('portfolios', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable(false);
            $table->string('slug')->nullable(false);
            $table->float('invested_capital')->nullable(true);
            $table->foreignIdFor(User::class)->constrained();
            $table->timestamps();

            $table->unique(['name', 'user_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('portfolios');
    }
}
