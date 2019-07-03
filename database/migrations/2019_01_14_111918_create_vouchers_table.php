<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVouchersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('vouchers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('voucher');
            $table->unsignedInteger('value');
            $table->unsignedInteger('user_id')->nullable();
            $table->string('class')->default('App\Vouchers');
            $table->string('type')->default('Vouchers');
            //$table->unsignedTinyInteger('transaction_type')->default(6);
            $table->unsignedTinyInteger('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('vouchers');
    }
}
