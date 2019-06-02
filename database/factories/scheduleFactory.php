<?php

use Faker\Generator as Faker;

$factory->define(\App\Schedule::class, function (Faker $faker) {
    return [
        'author_user_id' => function(){
            return factory(\App\User::class)->create()->id;
        },
        'schedulable_id' => 1,
        'schedulable_type'=> \App\Portal\App::class,
        'start_at' => $faker->dateTime(),
        'end_at' => $faker->dateTime(),
        'repeat' => $faker->sentence,
    ];
});
