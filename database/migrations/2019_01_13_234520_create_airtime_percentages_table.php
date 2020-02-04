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
            $table->boolean('addon')->default(false);
            $table->string('group_network')->nullable();
            $table->boolean('has_addon')->default(false);
            $table->string('alternate_name')->nullable();
            $table->string('transfer_code')->nullable();
            $table->json('airtime_to_cash_phone_numbers');
            $table->unsignedInteger('process_time')->default(30);
            $table->unsignedTinyInteger('airtime_swap_percentage');
            $table->unsignedTinyInteger('airtime_to_cash_percentage');
            $table->unsignedInteger('airtime_to_cash_min')->nullable();
            $table->unsignedInteger('airtime_to_cash_max')->nullable();
            $table->boolean('airtime_swap_percentage_status')->default(true);
            $table->boolean('airtime_to_cash_percentage_status')->default(true);
            $table->unsignedTinyInteger('airtime_topup_percentage')->default(100);
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
        Schema::dropIfExists('airtime_percentages');
    }
}
