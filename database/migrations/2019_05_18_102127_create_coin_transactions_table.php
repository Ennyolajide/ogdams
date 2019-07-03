<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoinTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coin_transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('coin');
            $table->string('type');
            $table->integer('rate');
            $table->integer('amount');
            $table->integer('user_id');
            $table->string('wallet')->nullable(); //for purchase
            $table->string('class')->default('App\Coins');
            $table->unsignedTinyInteger('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coin_transactions');
    }
}
