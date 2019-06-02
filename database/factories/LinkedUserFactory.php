<?php

use Faker\Generator as Faker;

$factory->define(App\LinkedUser::class, function (Faker $faker) {
    return [
        'userable_id' => null,
        'userable_type' => null,
        'user_id' => null,
    ];
});
