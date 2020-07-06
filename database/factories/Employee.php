<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Employee;
use App\User;
use Faker\Generator as Faker;

$factory->define(Employee::class, function (Faker $faker) {
    return [
        "user_id" => function() {
            return factory(User::class)->create()->id;
        },
        "sex"     => $faker->randomElement($array = ['m', 'w']),
        "address" => $faker->address
    ];
});
