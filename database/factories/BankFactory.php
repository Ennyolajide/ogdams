<?php

use Faker\Generator as Faker;

$factory->define(App\Bank::class, function (Faker $faker) {
    return [
        //
        'user_id' => 1,
        'bank_name' => $faker->company,
        'acc_name' => $faker->name,
        'acc_no' => $faker->numberBetween(1002020001, 9999999999),
    ];
});
