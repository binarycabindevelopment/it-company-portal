<?php

use Faker\Generator as Faker;

$factory->define(\App\Product::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'sku'=> $faker->unique()->numberBetween($min = 1000, $max = 9000),
        'category' => $faker->word,
        'supplier' => $faker->company,
        'brand' => $faker->word,
        'description' => $faker->paragraph,
        'buy_price_cents' => $faker->numberBetween($min = 1, $max = 50)*100,
        'wholesale_price_cents' => $faker->numberBetween($min = 1, $max = 50)*100,
        'retail_price_cents' => $faker->numberBetween($min = 1, $max = 50)*100,
        'stock' => $faker->numberBetween($min = 1, $max = 50),
    ];
});
