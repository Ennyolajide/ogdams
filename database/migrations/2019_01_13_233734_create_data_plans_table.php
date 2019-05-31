<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDataPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_plans', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedTinyInteger('network_id');
            $table->string('network');
            $table->string('volume');
            $table->string('notification_phone_number')->default('07063637002');
            $table->unsignedInteger('amount');
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
        Schema::dropIfExists('data_plans');
    }
}
