<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Spot;
use Faker\Generator as Faker;

$factory->define(Spot::class, function (Faker $faker) {
    return [
        'slug' => substr($faker->unique()->slug($nbWords = 3), 0, 50),
        'title' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'description' => $faker->sentence($nbWords = 20, $variableNbWords = true),
        'address' => $faker->streetAddress,
        'locality' => $faker->city,
        'region' => $faker->state,
        'postcode' => $faker->postcode,
        'country' => $faker->countryCode,
    ];
});
