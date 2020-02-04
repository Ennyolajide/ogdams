<?php

use Faker\Generator as Faker;

$factory->define(App\Voucher::class, function (Faker $faker) {
    return [
        //
        'voucher' => $faker->creditCardNumber,
        'value'   => $faker->numberBetween(1,20).'000',

    ];
});
