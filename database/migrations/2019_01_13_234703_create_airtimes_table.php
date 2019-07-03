<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAirtimesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('airtimes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('amount');
            $table->string('from_network')->nullable(); //for airtime swaps only
            $table->string('to_network')->nullable();  //for airtime swaps
            $table->unsignedInteger('percentage')->nullable();  //for airtime to Cash only
            $table->string('from_phone')->nullable();   //for both airtime swaps and airtime to cash
            $table->string('to_phone')->nullable(); //for airtime swap,airtime to cash and airtime topup(phone)
            $table->string('network')->nullable(); //for airtime topup only
            $table->string('class')->default('App\Airtimes');
            $table->string('type');
            $table->unsignedBigInteger('bank_id')->nullable();
            $table->json('recipients')->nullable();
            $table->unsignedInteger('status')->default(1)->nullable();
            $table->unsignedTinyInteger('transaction_type'); // 1 for topup | 2 for airtime to cash | 3 for airtime swap | 4 for airtime funding
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('airtimes');
    }
}
