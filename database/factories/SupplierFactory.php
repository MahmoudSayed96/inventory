<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Supplier;
use Faker\Generator as Faker;

$factory->define(Supplier::class, function (Faker $faker) {
    return [
        'name' => $faker->name(),
        'email' => $faker->email(),
        'address' => $faker->address(),
        'phone' => $faker->phoneNumber(),
        'shop_name' => $faker->name(),
        'photo' => $faker->imageUrl($width = 640, $height = 480),
    ];
});
