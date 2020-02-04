<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRingoProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ringo_products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('product_id');
            $table->string('service');
            $table->string('service_id');
            $table->integer('min_amount')->default(0);
            $table->integer('max_amount')->default(0);
            $table->integer('step')->default(100);
            $table->boolean('validation')->default(false);
            $table->boolean('multichoice')->default(false);
            $table->boolean('product_list')->default(false);
            $table->string('logo');
            $table->string('route');
            $table->boolean('status')->default(true);
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
        Schema::dropIfExists('ringo_products');
    }
}
