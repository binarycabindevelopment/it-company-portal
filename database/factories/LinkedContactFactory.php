<?php

use Faker\Generator as Faker;

$factory->define(App\LinkedContact::class, function (Faker $faker) {
    return [
        'contactable_id' => null,
        'contactable_type' => null,
        'contact_id' => null,
    ];
});
