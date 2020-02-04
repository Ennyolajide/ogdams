<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBulkSmsConfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bulk_sms_configs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('route');
            $table->unsignedTinyInteger('routing');
            $table->string('description')->nullable();
            $table->unsignedInteger('amount_per_unit'); // in kobo

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
        Schema::dropIfExists('bulk_sms_configs');
    }
}
