<?php

use Faker\Generator as Faker;

$factory->define(App\Participant::class, function (Faker $faker) {
    return [
        'lastname' => $faker->firstName(),
        'firstname' => $faker->firstName(),
        'gender' => $faker->randomElement(['M', 'F', 'O']),
        'birthday' => $faker->date(),
        'station' => $faker->company,
        'mobile' => $faker->phoneNumber,
        'email' => $faker->email
    ];
});
