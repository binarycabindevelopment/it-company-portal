<?php

use Faker\Generator as Faker;

$factory->define(\App\Event::class, function (Faker $faker) {
    $date = \Carbon\Carbon::parse($faker->dateTimeThisCentury()->format('Y-m-d g:h'));
    return [
        'author_user_id' => function(){
            return factory(\App\User::class)->create()->id;
        },
        'eventable_id' => function(){
            return factory(\App\Schedule::class)->create()->id;
        },
        'eventable_type'=> \App\Schedule::class,
        'name' => $faker->word,
        'repeat' => $faker->word,
        'details' => $faker->text,
        'type' => $faker->text,
        'constraint' => $faker->boolean(20),
        'start_at' => $date,
        'end_at' => $date->addHour(1),
    ];
});
