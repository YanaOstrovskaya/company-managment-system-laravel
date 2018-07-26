<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Company::class, function (Faker $faker) {
    return [
        'logo' => 'default-logo.png',
        'name' => $faker->company,
        'adress_line1' => $faker->streetAddress,
        'adress_line2' => $faker->secondaryAddress,
        'zip' => $faker->numberBetween($min = 1000, $max = 9000),
        'city' => $faker->city,
        'country' => $faker->country
    ];
});
