<?php

use Faker\Generator as Faker;

$factory->define(App\Note::class, function (Faker $faker) {
    return [
        'notable_id' => null,
        'notable_type' => null,
        'author_user_id'=>  function(){
            return factory(\App\User::class)->create()->id;
        },
        'title' => $faker->word,
        'body' => $faker->sentence,
    ];
});
