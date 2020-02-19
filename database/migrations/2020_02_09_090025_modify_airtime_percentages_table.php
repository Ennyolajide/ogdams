<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyAirtimePercentagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('airtime_percentages', function (Blueprint $table) {
            $table->string('hosted_sim_api_token')->nullable();
            $table->string('hosted_sim_server_token')->nullable();
            $table->string('airtime_topup_ussd_code')->nullable();
            $table->boolean('airtime_topup_status')->default(true);
            $table->boolean('airtime_topup_sim_route')->default(false);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('airtime_percentages', function (Blueprint $table) {
            //
        });
    }
}
