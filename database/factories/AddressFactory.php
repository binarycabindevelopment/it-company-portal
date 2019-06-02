<?php

use Faker\Generator as Faker;

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Address::class, function (Faker $faker) {
    return [
        'addressable_type' => null,
        'addressable_id' => null,
        'type' => substr($faker->jobTitle,0,50),
        'address_1' => $faker->streetAddress,
        'address_2' => 'test',
        'city' => $faker->city,
        'state' => $faker->stateAbbr,
        'zipcode' => $faker->postcode,
        'county' => $faker->word,
        'country' => $faker->country,
    ];
});
