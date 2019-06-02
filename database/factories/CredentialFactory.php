<?php

use Faker\Generator as Faker;

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Credential::class, function (Faker $faker) {
    $password = $faker->password;
    return [
        'uuid' => $faker->uuid,
        'author_user_id' => function(){
            return factory(\App\User::class)->create()->id;
        },
        'name' => $faker->company,
        'url' => $faker->url,
        'username' => $faker->userName,
        'password_encrypted' => \Crypt::encryptString($password),
    ];
});
