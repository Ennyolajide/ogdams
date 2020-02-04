<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email', 40)->unique();
            $table->boolean('active')->default(false);
            $table->string('facebook_id')->nullable();
            $table->string('token')->nullable();
            $table->string('role')->default('customer');
            $table->boolean('permission')->default(false);
            $table->string('number')->nullable();
            $table->unsignedBigInteger('balance')->default(0);
            $table->string('avatar')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('pin')->nullable();
            $table->unsignedBigInteger('referrer')->nullable();
            $table->string('wallet_id')->unique();
            $table->boolean('first_time_funding')->default(true);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
