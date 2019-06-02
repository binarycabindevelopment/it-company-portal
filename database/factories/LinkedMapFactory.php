<?php

use Faker\Generator as Faker;

$factory->define(App\LinkedMap::class, function (Faker $faker) {
    
    return [
        'mappable_id'=> function(){
            return factory(\App\Asset::class)->create()->id;
        },
        'mappable_type'=> \App\Asset::class,
        'map_id'=> function(){
            return factory(\App\Map::class)->create()->id;
        },
    ];
});
