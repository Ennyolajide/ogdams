<?php

use Faker\Generator as Faker;

$factory->define(App\Bvn::class, function (Faker $faker) {
    return [
        //
        'user_id' => 3,
        'bvn' => $faker->e164PhoneNumber,
    ];
});
