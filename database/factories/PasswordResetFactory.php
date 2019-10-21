<?php

use Faker\Generator as Faker;

$factory->define(App\PasswordReset::class, function (Faker $faker) {

    return [
        //
        'email' => 'a@a.com',
        'token' => $faker->uuid,
        'created_at' => NULL
    ];
});
