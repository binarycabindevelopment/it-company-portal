<?php

use Faker\Generator as Faker;

$factory->define(App\Ticket::class, function (Faker $faker) {
    return [
        'uuid' => $faker->uuid,
        'author_user_id' => function(){
            return factory(\App\User::class)->create()->id;
        },
        'title' => $faker->jobTitle,
        'service_board' => $faker->sentence,
        'ticketable_type' =>  \App\Facility::class,
        'ticketable_id' => function(){
            return factory(\App\Facility::class)->create()->id;
        },
        'status' => $faker->randomKey(\App\Options\TicketStatus::get()),
        'type' => $faker->word,
        'sub_type' => $faker->word,
        'item' => $faker->word,
        'source' => $faker->sentence,
        'priority' => $faker->word,
        'summary' => $faker->text,
        'details' => $faker->text,
        'analysis' => $faker->text,
        'resolution' => $faker->text,
        'configuration_name' => $faker->name,
        'resource_member' => $faker->name,
        'completed_at' =>  $faker->dateTimeThisCentury,
    ];
});
