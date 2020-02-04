<?php

use Faker\Generator as Faker;

$factory->define(App\AirtimeToCash::class, function (Faker $faker) {
    return [
        //
        'user_id' => $faker->numberBetween(1,2),
        'amount' => $faker->numberBetween(1000,20000),
        'from' => $faker->e164PhoneNumber,
        'to' => $faker->e164PhoneNumber,
        'percentage' => 75,
        'network' => 'MTN'
    ];
});
