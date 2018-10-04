<?php

use Faker\Generator as Faker;

$factory->define(App\Participant::class, function (Faker $faker) {
    return [
        'lastname' => $faker->firstName(),
        'firstname' => $faker->firstName(),
        'gender' => $faker->randomElement(['M', 'F', 'O']),
        'jobtitle_id' => $faker->numberBetween(1, 50),
        'region_id' => $faker->numberBetween(1, 19),
        'division_id' => $faker->numberBetween(1, 216),
        'birthday' => $faker->date(),
        'station' => $faker->company,
        'mobile' => $faker->phoneNumber,
        'email' => $faker->email
    ];
});
