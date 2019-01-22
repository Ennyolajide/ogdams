<?php

use Faker\Generator as Faker;

$factory->define(App\Message::class, function (Faker $faker) {
    return [
        //
        'user_id' => $faker->numberBetween(1,2),
        'subject' => $faker->sentence(3),
        'content' => $faker->paragraph(3),
        'sender_id' => 1
    ];
});
