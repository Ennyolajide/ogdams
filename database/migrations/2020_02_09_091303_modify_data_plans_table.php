<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyDataPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('data_plans', function (Blueprint $table) {
            $table->boolean('hosted_sim_status')->default(false);
            $table->string('hosted_sim_api_token')->nullable();
            $table->string('hosted_sim_server_token')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('data_plans', function (Blueprint $table) {
            //
        });
    }
}
