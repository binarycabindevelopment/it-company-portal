<?php

use Faker\Generator as Faker;

$factory->define(App\LinkedEmployee::class, function (Faker $faker) {
    return [
        'employeeable_id' => null,
        'employeeable_type' => null,
        'employee_id' => function(){
            return factory(\App\Employee::class)->create()->id;
        },
    ];
});
