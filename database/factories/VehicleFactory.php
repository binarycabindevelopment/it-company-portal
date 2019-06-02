<?php

use Faker\Generator as Faker;

$factory->define(App\Vehicle::class, function (Faker $faker) {
    return [
        'author_user_id' =>  function(){
            return factory(\App\User::class)->create()->id;
        },
        'make' => $faker->word,
        'model'=> $faker->word,
        'year'=> $faker->year,
        'vin'=> $faker->numberBetween(1000000,9999999),
    ];
});
