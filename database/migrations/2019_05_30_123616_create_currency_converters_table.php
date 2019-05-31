<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCurrencyConvertersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('currency_converters', function (Blueprint $table) {
            $table->increments('id');
            $table->string('currency')->unique();
            $table->unsignedBigInteger('rate');
            $table->string('description')->default('conversion of 1 USD to naira');
            $table->dateTime('expires')->nullable();
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
        Schema::dropIfExists('currency_converters');
    }
}
