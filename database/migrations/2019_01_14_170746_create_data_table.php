<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDataTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('data', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('user_id');
            $table->string('network');
            $table->unsignedInteger('amount');
            $table->string('volume');
            $table->string('phone');
            $table->string('class')->default('App\Data');
            $table->string('type')->default('Data Topup');
            //$table->unsignedTinyInteger('transaction_type')->default(5);
            $table->unsignedTinyInteger('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('data');
    }
}
