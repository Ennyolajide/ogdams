<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBankTransfersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('bank_transfers', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('amount');
            $table->unsignedBigInteger('bank_id');
            $table->string('class');
            $table->string('type')->default('Bank Transfer');
            $table->unsignedTinyInteger('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('bank_transfers');
    }
}
