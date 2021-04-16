<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Employee;
use Faker\Generator as Faker;

$factory->define(Employee::class, function (Faker $faker) {
    return [
        'name' => $faker->name(),
        'email' => $faker->email(),
        'address' => $faker->address(),
        'phone' => $faker->phoneNumber(),
        'nid' => $faker->isbn10(),
        'joining_date' => Carbon\Carbon::now(),
        'photo' => $faker->imageUrl($width = 640, $height = 480),
        'salary' => $faker->randomFloat(2, 1500, 10000)
    ];
});
