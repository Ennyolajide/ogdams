<?php

use Faker\Generator as Faker;

$factory->define(App\Transaction::class, function (Faker $faker) {
    $data = factory(App\Data::class)->make()->create([
        'user_id' => 2,
        'network' => 'MTN',
        'amount' => 1500,
        'volume' => '3GB',
        'phone' => $faker->e164PhoneNumber,
        'class' => 'App\Data',
    ]);

    return [
        'user_id' => $faker->numberBetween(1, 2),
        'amount' => $faker->numberBetween(1, 20).'000',
        'balance_before' => $faker->numberBetween(1, 20).'0000',
        'balance_after' => $faker->numberBetween(1, 20).'000',
        'class_type' => $data->class,
        'class_id' => $data->id,
        'method' => 'bank Transfer',
        'reference' => time(),
    ];
});
