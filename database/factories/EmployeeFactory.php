<?php

use Faker\Generator as Faker;

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Employee::class, function (Faker $faker) {
    return [
        'uuid' => $faker->uuid,
        'key' => strtoupper($faker->randomLetter).$faker->numberBetween(10000,90000),
    ];
});