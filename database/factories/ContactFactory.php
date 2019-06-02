<?php

use Faker\Generator as Faker;

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Contact::class, function (Faker $faker) {
    return [
        'contactable_type' => function(){
            return factory(\App\Customer::class)->create()->id;
        },
        'contactable_id' => \App\Customer::class,
        'title' => $faker->title,
        'first_name' => $faker->firstName,
        'middle_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->email,
        'job_title' => $faker->jobTitle,
    ];
});
