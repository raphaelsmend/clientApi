<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Address;
use Faker\Generator as Faker;

$factory->define(Address::class, function (Faker $faker) {
    return [
        "city"=> $faker->city,
        "district"=> $faker->streetSuffix,
        "state"=> $faker->state,
        "street" => $faker->streetName,
        "zipCode" => $faker->numberBetween($min = 1, $max = 9000),
    ];
});
