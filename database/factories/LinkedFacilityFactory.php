<?php

use Faker\Generator as Faker;

$factory->define(\App\LinkedFacility::class, function (Faker $faker) {
    return [
        'facilityable_id' => function(){
            return factory(\App\Ticket::class)->create()->id;
        },
        'facilityable_type' => \App\Ticket::class,
        'facility_id'=> function() {
            return factory(\App\Facility::class)->create()->id;
        }
    ];
});
