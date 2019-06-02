<?php

use Faker\Generator as Faker;

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Monitor::class, function (Faker $faker) {
    return [
        'uuid' => $faker->uuid,
        'author_user_id' => function(){
            return factory(\App\User::class)->create()->id;
        },
        'url' => $faker->url,
        'expected_status_code' => $faker->randomKey(\App\Options\HttpStatusCode::get()),
        'expected_response_content' => null,
    ];
});
