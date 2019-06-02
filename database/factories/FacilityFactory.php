<?php

use Faker\Generator as Faker;

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Facility::class, function (Faker $faker) {
    $company = $faker->company;
    return [
        'uuid' => $faker->uuid,
        'facilityable_type' => App\Customer::class,
        'facilityable_id' => function(){
            return factory(\App\Customer::class)->create()->id;
        },
        'name' => $company,
        'key' => strtoupper(substr($company, 0, 3)),
        'number_of_employees' => $faker->numberBetween(0,1000),
        'annual_revenue_cents' => $faker->numberBetween(100000,999999),
    ];
});