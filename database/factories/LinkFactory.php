<?php

use Faker\Generator as Faker;

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Link::class, function (Faker $faker) {
    return [
        'linkable_type' => null,
        'linkable_id' => null,
        'label' => $faker->jobTitle,
        'type' => null,
        'url' => $faker->url,
        'weight' => $faker->numberBetween(0,10),
    ];
});