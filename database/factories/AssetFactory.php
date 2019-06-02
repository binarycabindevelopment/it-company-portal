<?php

use Faker\Generator as Faker;

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Asset::class, function (Faker $faker) {
    return [
        'uuid' => $faker->uuid,
        'assetable_type' => \App\Facility::class,
        'assetable_id' => function(){
            return factory(\App\Facility::class)->create()->id;
        },
        'author_user_id' => function(){
            return factory(\App\User::class)->create()->id;
        },
        'type' => $faker->word,
        'category' => $faker->randomKey(\App\Options\AssetCategory::get()),
        'name' => $faker->word,
        'tag_key' => $faker->numberBetween(1000,9999),
        'sales_vendor_name' => $faker->company,
        'support_vendor_id' => function(){
            return factory(\App\SupportVendor::class)->create()->id;
        },
        'manufacturer' => $faker->company,
        'serial_number' => $faker->randomLetter.$faker->numberBetween(100000,999999),
        'model_number' => $faker->randomLetter.$faker->numberBetween(100000,999999),
        'client_tag' => $faker->randomLetter.$faker->numberBetween(100000,999999),
        'purchase_at' => $faker->dateTimeThisCentury,
        'installed_at' => $faker->dateTimeThisCentury,
        'installed_by' => $faker->firstName.' '.$faker->lastName,
        'warranty_start_at' => $faker->dateTimeThisCentury,
        'warranty_end_at' => $faker->dateTimeThisCentury,
        'expires_at' => $faker->dateTimeThisCentury,
        'configuration_status' => $faker->word,
        'configuration_type' => $faker->word,
        'configuration_name' => $faker->word,
    ];
});
