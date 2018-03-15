<?php

use Faker\Generator as Faker;

$factory->define(App\Competition::class, function (Faker $faker) {
    $name = $faker->name;
    $shortname = substr($name,0,4);
    return [
        'name' => $name,
        'short_name' => $shortname,
        'start_date' => $faker->date($format = 'Y-m-d',$startDate = '-1 years', $endDate = 'now'),
    ];
});
