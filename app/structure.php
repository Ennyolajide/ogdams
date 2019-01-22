<?php

Schema::create('banks', function (Blueprint $table) {
    $table->increments('id');
    $table->unsignedInteger('user_id');
    $table->string('bank_name');
    $table->string('acc_name');
    $table->string('acc_no');
    $table->timestamps();
});

Schema::create('messages', function (Blueprint $table) {
    $table->increments('id');
    $table->unsignedInteger('user_id');
    $table->string('subject');
    $table->text('content');
    $table->string('sender_id');
    $table->boolean('read')->default(false);
    $table->unsignedInteger('reply')->nullable();
    $table->timestamps();
});

Schema::create('data_plans', function (Blueprint $table) {
    $table->increments('id');
    $table->unsignedInteger('network_id');
    $table->string('network');
    $table->string('volume');
    $table->unsignedInteger('amount');
    $table->timestamps();
});

Schema::create('datas', function (Blueprint $table) {
    $table->increments('id');
    $table->string('transaction_type')->default(1);
    $table->unsignedInteger('user_id');
    $table->string('network');
    $table->unsignedInteger('amount');
    $table->string('volume');
    $table->string('phone');
    $table->unsignedInteger('status')->default(1);
    $table->timestamps();
});

Schema::create('airtime_percentages', function (Blueprint $table) {
    $table->increments('id');
    $table->string('network');
    $table->unsignedInteger('airtime_to_cash_percentage');
    $table->boolean('airtime_to_cash_percentage_status')->default(true);
    $table->string('airtime_to_cash_phone_numbers')->nullable();
    $table->unsignedInteger('airtime_swap_percentage');
    $table->boolean('airtime_swap_percentage_status')->default(true);
    $table->string('airtime_swap_phone_numbers')->nullable();
    $table->timestamps();
});

Schema::create('airtimes', function (Blueprint $table) {
    $table->increments('id');
    $table->string('transaction_type');
    $table->unsignedInteger('user_id');
    $table->unsignedInteger('amount');
    $table->string('from_network')->nullable(); //for airtime swaps only
    $table->string('to_network')->nullable();  //for airtime swaps and airtime topup(network)
    $table->unsignedInteger('percentage')->nullable();  //for airtime to Cash only
    $table->string('from_phone')->nullable();   //for both airtime swaps and airtime to cash
    $table->string('to_phone'); //for airtime swap,airtime to cash and airtime topup(phone)
    $table->string('network')->nullable(); //for airtime topup  and fund with only
    $table->unsignedInteger('status')->default(1);
    $table->timestamps();
});

Schema::create('payment_gateways', function (Blueprint $table) {
    $table->increments('id');
    $table->string('name');
    $table->string('route');
    $table->boolean('status')->default(true);
    $table->timestamps();
});


Schema::create('transactions', function (Blueprint $table) {
    $table->increments('id');
    $table->unsignedInteger('user_id');
    $table->unsignedInteger('amount');
    $table->unsignedInteger('balance_before');
    $table->unsignedInteger('balance_after');
    $table->string('method');
    $table->unsignedTinyInteger('transaction_type_id');
    $table->unsignedBigInteger('transaction_id');
    $table->unsignedTinyInteger('status')->default(1);
    $table->timestamps();
});

Schema::create('vouchers', function (Blueprint $table) {
    $table->increments('id');
    $table->string('voucher');
    $table->unsignedInteger('value');
    $table->unsignedInteger('user_id')->nullable();
    $table->unsignedTinyInteger('transaction_type')->default(6);
    $table->boolean('status')->default(1);
    $table->timestamps();
});

