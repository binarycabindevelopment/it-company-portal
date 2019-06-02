<?php

use Faker\Generator as Faker;

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Phone::class, function (Faker $faker) {
    return [
        'phoneable_type' => null,
        'phoneable_id' => null,
        'type' => $faker->randomElement(\App\Options\PhoneType::get()),
        'number' => $faker->phoneNumber,
        'weight' => $faker->numberBetween(0,10),
    ];
});