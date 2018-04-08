<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

use Faker\Generator as Faker;


$factory->define(App\Club::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'address1' => $faker->streetAddress,
        'address2' => (rand(0, 100) % 5 == 0) ? $faker->secondaryAddress : '',
        'suburb' => $faker->city,
        'postcode' => $faker->postcode,
        'state' => $faker->state,
        'country' => $faker->country,
    ];
});


$factory->define(App\Competition::class, function (Faker $faker) {
    $name = $faker->name;
    $shortname = substr($name,0,4);
    return [
        'name' => $name,
        'short_name' => $shortname,
        'start_date' => $faker->date($format = 'Y-m-d',$startDate = '-1 years', $endDate = 'now'),
    ];
});


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

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
    ];
});

