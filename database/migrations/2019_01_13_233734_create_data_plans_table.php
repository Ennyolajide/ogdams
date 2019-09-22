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
            $table->bigIncrements('id');
            $table->unsignedTinyInteger('network_id');
            $table->string('network');
            $table->string('volume');
            $table->boolean('addon')->default(false);
            $table->boolean('available')->default(true);
            $table->string('notification_content')->default('*127*57*number#');
            $table->string('notification_phone')->default('07063637002');
            $table->boolean('phone_notification_status')->default(false);
            $table->string('notification_email')->default('test@test.com');
            $table->boolean('email_notification_status')->default(false);
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
