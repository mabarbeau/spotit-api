<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Notification;
use Faker\Generator as Faker;

$factory->define(Notification::class, function (Faker $faker) {
    $types = ['success', 'info', 'warning', 'error'];

    return [
        'message' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'type' => $types[rand(0, 3)],
    ];
});
