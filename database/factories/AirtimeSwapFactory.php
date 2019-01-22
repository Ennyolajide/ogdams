<?php

use Faker\Generator as Faker;

$factory->define(App\AirtimeSwap::class, function (Faker $faker) {
    return [
        //

        'user_id' => $faker->numberBetween(1,2),
        'amount' => $faker->numberBetween(1000,20000),
        'from_network' => 'MTN',
        'to_network' => 'GLO',
        'from' => $faker->e164PhoneNumber,
        'to' => $faker->e164PhoneNumber
    ];
});
