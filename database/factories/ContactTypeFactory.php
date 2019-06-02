<?php

use Faker\Generator as Faker;

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\ContactType::class, function (Faker $faker) {
    return [
        'contact_id' => null,
        'type' => $faker->randomKey(\App\Options\CustomerContactType::get()),
    ];
});