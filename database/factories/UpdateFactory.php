<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Spot;
use App\Update;
use Faker\Generator as Faker;

$factory->define(Update::class, function (Faker $faker) {
    $spot = Spot::inRandomOrder()->firstOrFail();
    return [
        'id' => $faker->uuid,
        'updatable_type' => Spot::class,
        'updatable_id' => $spot->id,
        'data' => factory(Spot::class)->make(['slug' => $spot->slug])->toJson(),
    ];
});
