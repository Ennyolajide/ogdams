<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('amount');
            $table->unsignedInteger('user_id');
            $table->json('object')->nullable();
            $table->string('reference')->unique();
            $table->string('class')->default('App\Payments');
            $table->string('type')->default('Card/Bitcoin');
            $table->unsignedTinyInteger('transaction_type');
            $table->unsignedTinyInteger('status')->default(1);
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
        Schema::dropIfExists('payments');
    }
}
