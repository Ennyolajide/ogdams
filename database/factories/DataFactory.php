<?php

use Faker\Generator as Faker;

$factory->define(App\Data::class, function (Faker $faker) {
    return [
        'user_id' => 2,
        'network' => 'MTN',
        'amount' => 1500,
        'volume' => '3GB',
        'phone' => $faker->e164PhoneNumber,
        'class' => 'App\Data',
    ];
});
