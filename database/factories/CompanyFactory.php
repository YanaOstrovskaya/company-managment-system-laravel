<?php

use Faker\Generator as Faker;

$factory->define(App\Company::class, function (Faker $faker) {
    return [
        'logo' => 'default-logo.png',
        'name' => $faker->company,
        'adress_line1' => $faker->streetAddress,
        'adress_line2' => $faker->secondaryAddress,
        'zip' => $faker->postcode,
        'city' => $faker->city,
        'country' => $faker->country
    ];
});
