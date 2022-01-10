<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Client;
use App\Models\Address;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Client::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'phone1' => $faker->phoneNumber,
        'address_id' => factory(Address::class)->create()->id,
        'address_number' => $faker->numberBetween($min = 1, $max = 9000),
    ];
});
