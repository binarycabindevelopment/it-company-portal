<?php

use Faker\Generator as Faker;

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\AssetContact::class, function (Faker $faker) {
    return [
        'asset_id' => function(){
            return factory(\App\Asset::class)->create()->id;
        },
        'contact_id' => function(){
            return factory(\App\Contact::class)->create()->id;
        },
    ];
});
