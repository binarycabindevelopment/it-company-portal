<?php

use Faker\Generator as Faker;

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker $faker) {
    static $password;
    return [
        'role' => $faker->randomKey(\App\Options\Role::get()),
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => rand(0,9999).$faker->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});