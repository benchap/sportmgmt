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
    $start_date =  $faker->dateTimeBetween($startDate = "now", $endDate = "30 days")->format('Y-m-d');
    $end_date = $faker->dateTimeBetween($startDate = $start_date, $endDate = "90 days")->format('Y-m-d');

    return [
        'user_id' => function(){
            return factory('App\User')->create()->id;
        },
        'name' => $name,
        'short_name' => $shortname,
        'start_date' => $start_date,
        'end_date' => $end_date,
        'ctype' => 'Rounds',
        'frequency' => 'Weekly',
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

$factory->define(App\Membership::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'cost' => '13500'
    ];
});

