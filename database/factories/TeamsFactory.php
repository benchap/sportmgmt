<?php

use Faker\Generator as Faker;

$factory->define(App\Teams::class, function (Faker $faker) {
    return [
  		'name' => $faker->name,
        'club_id' => function() {
        	return factory('App\Club')->create()->id;
        },
        'competition_id' => function() {
        	return factory('App\Competition')->create()->id;
        }
    ];
});
