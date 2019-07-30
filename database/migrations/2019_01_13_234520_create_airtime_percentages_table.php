<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAirtimePercentagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('airtime_percentages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('network');
            $table->string('transfer_code')->nullable();
            $table->json('airtime_to_cash_phone_numbers');
            $table->unsignedInteger('process_time')->default(30);
            $table->unsignedTinyInteger('airtime_swap_percentage');
            $table->unsignedTinyInteger('airtime_to_cash_percentage');
            $table->boolean('airtime_swap_percentage_status')->default(true);
            $table->boolean('airtime_to_cash_percentage_status')->default(true);
            $table->unsignedTinyInteger('airtime_topup_percentage')->default(100);
            $table->timestamps();


            //$table->unsignedInteger('time_out')->default(120);
            //$table->string('airtime_swap_phone_number_one');
            //$table->string('airtime_swap_phone_number_two')->nullable();



        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('airtime_percentages');
    }
}
