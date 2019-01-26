<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAirtimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('airtimes', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedTinyInteger('transaction_type');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('amount');
            $table->string('from_network')->nullable(); //for airtime swaps only
            $table->string('to_network')->nullable();  //for airtime swaps 
            $table->unsignedInteger('percentage')->nullable();  //for airtime to Cash only
            $table->string('from_phone')->nullable();   //for both airtime swaps and airtime to cash
            $table->string('to_phone'); //for airtime swap,airtime to cash and airtime topup(phone)
            $table->string('network')->nullable(); //for airtime topup only
            $table->unsignedInteger('status')->default(1);
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
        Schema::dropIfExists('airtimes');
    }
}
