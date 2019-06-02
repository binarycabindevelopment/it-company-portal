<?php

use Faker\Generator as Faker;

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Map::class, function (Faker $faker) {
    return [
        'uuid' => $faker->uuid,
        'mappable_type' => null,
        'mappable_id' => null,
        'name' => 'Building '.$faker->numberBetween(1,10),
    ];
});
