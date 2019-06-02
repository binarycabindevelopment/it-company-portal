<?php

use Faker\Generator as Faker;

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Ping::class, function (Faker $faker) {
    return [
        'pingable_type' => \App\Monitor::class,
        'pingable_id' => function(){
            return factory(\App\Monitor::class)->create()->id;
        },
        'url' => $faker->url,
        'status_code' => $faker->randomKey(\App\Options\HttpStatusCode::get()),
        'response_content' => null,
    ];
});
