<?php

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
