<?php

use Faker\Generator as Faker;

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Logo::class, function (Faker $faker) {
    return [
        'logoable_type' => App\Customer::class,
        'logoable_id' => function(){
            return factory(\App\Customer::class)->create()->id;
        },
        'weight' => $faker->numberBetween(0,20),
        'file_name' => $faker->uuid.'.jpg',
    ];
});