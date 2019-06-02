<?php

use Faker\Generator as Faker;

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Customer::class, function (Faker $faker) {
    $company = $faker->company;
    return [
        'uuid' => $faker->uuid,
        'name' => $company,
        'key' => strtoupper(substr($company, 0, 3)),
        'sic_code' => $faker->numberBetween(1000,9000),
        'tax_code' => strtoupper($faker->randomLetter).$faker->numberBetween(100,900),
        'tax_id' => $faker->numberBetween(10,99).'-'.$faker->numberBetween(1000000,9999999),
        'number_of_employees' => $faker->numberBetween(0,1000),
        'annual_revenue_cents' => $faker->numberBetween(100000,999999),
    ];
});