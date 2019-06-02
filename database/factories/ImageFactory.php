<?php

use Faker\Generator as Faker;

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Image::class, function (Faker $faker) {
    return [
        'imageable_type' => App\Facility::class,
        'imageable_id' => function(){
            return factory(\App\Facility::class)->create()->id;
        },
        'weight' => $faker->numberBetween(0,20),
        'file_name' => $faker->uuid.'.jpg',
    ];
});